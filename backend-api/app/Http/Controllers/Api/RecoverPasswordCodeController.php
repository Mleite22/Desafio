<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\SendEmailForgotPasswordCode;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            $userPasswordResets = DB::table('password_reset_tokens')
                ->where(['email', $request->email]);

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
        
}
