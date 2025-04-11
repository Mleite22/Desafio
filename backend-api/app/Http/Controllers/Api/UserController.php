<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\JobSendWelcomeEmail;
use App\Models\User;
use App\Services\UserRegistrationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Este médoto retorna uma lista paginada de usuários do 
     * banco de dados retornando como um json.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        //Recuperando usuarios do banco
        $users = User::orderBy('id', 'ASC')->paginate(3);
        //Retorna os usuarios
        return response()->json([
            'status' => true,
            'users' =>  $users,
        ], 200);
    }

    //Visualizar usuario
    public function show($id): JsonResponse
    {
        //Recuperando usuario pelo id 
        $user = User::find($id);
        //$user = Auth::user();
        //Verificando se o usuario existe
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario não encontrado ou inexistente',

            ], 400);
        }
        //Retornando usuario
        return response()->json([
            'status' => true,
            'user' => $user,

        ], 200);
    }

    //Cadastrar ususario
    public function store(UserRequest $request): JsonResponse
    {
        //Iniciar a transação
        DB::beginTransaction();
        try {
            //Criando usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            //Verificando se o usuario foi criado
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Usuário já cadastrado ou não foi possível cadastrar',
                ], 400);               
            }
            // Enviando email de boas vindas sem fila para teste
            //Mail::to($user->email)->send(new \App\Mail\SendWelcomeEmail($user));

            // Enviando email de boas vindas com fila
            JobSendWelcomeEmail::dispatch($user->id)->onQueue('default');

            //Comitando a transação
            DB::commit();
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuário cadastrado com sucesso',
            ], 201);
            
        } catch (Exception $e) {
            //Desfazendo a transação
            DB::rollBack();
        
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário',
            ], 400);
        }
    }

    //Editar usuario
    public function update(UserRequest $request): JsonResponse
    {
        try {
            $user = Auth::user(); // Obtém o usuário autenticado

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Usuário não encontrado'
                ], 404);
            }

            // Validação dos dados antes de atualizar
            $data = $request->only(['name', 'email', 'password']);
            if (empty($data['password'])) {
                unset($data['password']); // Remove o campo 'password' se estiver vazio
            } else {
                $data['password'] = bcrypt($data['password']); // Criptografa a senha
            }

            $user->update($data); // Atualiza o usuário autenticado

            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Perfil atualizado com sucesso!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar usuário: ' . $e->getMessage()
            ], 500);
        }
    }


    //Deletar usuario
    public function destroy($id): JsonResponse
    {
        try {
            //Deletar o registro no banco de dados
            User::destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Usuario deletado com sucesso!',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao deletar usuário'

            ], 400);
        }
    }
}
