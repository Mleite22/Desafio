<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordCodeRequest;
use App\Http\Requests\ResetPasswordValidateCodeRequest;
use App\Mail\SendEmailForgotPasswordCode;
use App\Models\User;
use App\Service\ResetPasswordValidateCodeService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class RecoverPasswordCodeController extends Controller
{
    
    /**
     * Handle the incoming request.
     */
    public function forgotPasswordCode(ForgotPasswordRequest $request): JsonResponse
    {
        // Recuperar os dados do usuário no banco de dados com o e-mail
        $user = User::where('email', $request->email)->first();

        // Verifica se o usuário existe
        if (!$user) {
            //Salvar log
            Log::warning('Usuário não encontrado.' . $request->email);
            return response()->json([
                'error' => 'Usuário não encontrado.'
            ], 400);
        }
        try {
            // Recuperar os registros recuperar senha do usuário
            $userPasswordResets = DB::table('password_reset_tokens')->where([
                ['email', $request->email]
            ]);

            // Se existir token cadastrado para o usuário recuperar senha, excluir o mesmo
            if ($userPasswordResets->exists()) {
                $userPasswordResets->delete();
            }
            // Gerar o código com 6 digitos
            $code = mt_rand(100000, 999999);

            // Criptografar o código
            $token = Hash::make($code);

            // Salvar o token no banco de dados
            $userNewPasswordResets = DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            // Enviar e-mail após cadastrar no banco de dados novo token recuperar senha
            if($userNewPasswordResets) {
                // Obter a data atual
                $currentDate = Carbon::now();

                // adicionar  1 hora
                $oneHourLater = $currentDate->addHour();

                // Formatar data e hora
                $formattedTime = $oneHourLater->format('H:i');
                $formattedDate = $oneHourLater->format('d/m/Y');

                // Enviar e-mail com o código
                Mail::to($user->email)->send(new SendEmailForgotPasswordCode($user, $code, $formattedDate, $formattedTime));
            }
            // Salvar log
            Log::info('Recuperar senha.', ['email' => $request->email]);
            
            return response()->json([
                'status' => true,
                'message' => 'Código de recuperação enviado com sucesso.',
            ], 200);

        } catch (Exception $e) {
            //Salvar log
            Log::warning("Erro ao recuperar a senha", ['email' => $request->email, 'error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erro ao recuperar a senha.',
            ], 400);
        }
    }

    public function resetPasswordValidateCode(ResetPasswordValidateCodeRequest $request, ResetPasswordValidateCodeService $resetPasswordValidateCode): JsonResponse
    {
        try {
            // validar o código do token
            $validationResult = $resetPasswordValidateCode->resetPasswordValidateCode($request->email, $request->code);

            // Verifica o resultado da validação
            if (!$validationResult['status']){

                return response()->json([
                    'status' => false,
                    'message' => $validationResult['message'],
                ], 400);
            }
            // Recuperar os dados do usuário no banco de dados com o e-mail
            $user = User::where('email', $request->email)->first();

            // Verifica se o usuário existe
            if (!$user) {

                //Salvar log
                Log::notice('Usuário não encontrado.', ['email' => $request->email]);
                return response()->json([
                    'status' => false,
                    'error' => 'Usuário não encontrado.'
                ], 400);
            }

            // Salvar log
            Log::info('Código de recuperação de senha validado.', ['email' => $request->email]);
            return response()->json([
                'status' => true,
                'message' => 'Código de recuperação de senha validado com sucesso.',
            ], 200);

        } catch (Exception $e){

            // Salvar log
            Log::warning('Erro validar código recuperar senha.', ['email' => $request->email, 'error' => $e->getMessage()]);

            return response()->json([
                'status' => false,
                'message' => 'Código inválido!',
            ], 400);
        }
    }

    public function resetPasswordCode(ResetPasswordCodeRequest $request, ResetPasswordValidateCodeService $resetPasswordValidateCode): JsonResponse
    {
        // validar o código do token
        $validationResult = $resetPasswordValidateCode->resetPasswordValidateCode($request->email, $request->code);

        // Verifica o resultado da validação
        if (!$validationResult['status']){

            return response()->json([
                'status' => false,
                'message' => $validationResult['message'],
            ], 400);
        }
        try {
            // Recuperar os dados do usuário no banco de dados com o e-mail
            $user = User::where('email', $request->email)->first();

            // Verifica se o usuário existe
            if (!$user) {
                //Salvar log
                Log::warning('Usuário não encontrado.', ['email' => $request->email]);
                return response()->json([
                    'status' => false,
                    'error' => 'Usuário não encontrado.'
                ], 400);
            }

            // Atualizar a senha do usuário
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            // gerar o token
            $token = $user->first()->createToken('api-token')->plainTextToken;

            // Recuperar os registros recuperar senha do usuário
            $userPasswordResets = DB::table('password_reset_tokens')->where([
                ['email', $request->email]
            ]);
            // Se existir token cadastrado para o usuário recuperar senha, excluir o mesmo
            if ($userPasswordResets->exists()) {
                $userPasswordResets->delete();
            }

            // Salvar log
            Log::info('Senha redefinida com sucesso.', ['email' => $request->email]);

            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $token,
                'message' => 'Senha redefinida com sucesso.',
            ], 200);

        } catch (Exception $e) {
            //Salvar log
            Log::warning('Erro ao redefinir a senha.', ['email' => $request->email, 'error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erro ao redefinir a senha.',
            ], 400);
        }
    }
        
}
