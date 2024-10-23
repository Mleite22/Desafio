<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Este médoto retorna uma lista paginada de usuários do 
     * banco de dados retornando como um json.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : JsonResponse
    {
        //Recuperando usuarios do banco
        $users = User::orderBy('id', 'ASC')->paginate(3);
        //Retorna os usuarios
        return response()->json([
            'status' => true,
            'users' =>  $users,
        ],200);

    }

    //Visualizar usuario
    public function show($id) : JsonResponse
    {
        //Recuperando usuario pelo id
        $user = User::find($id);
        //$user = Auth::user();
        //Verificando se o usuario existe
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario não encontrado ou inexistente',
                
            ],400);
        }
        //Retornando usuario
        return response()->json([
            'status' => true,
            'user' => $user,

        ],200);
    }

    //Cadastrar ususario
    public function store(UserRequest $request) : JsonResponse
    {
        //Iniciar a transação
        DB::beginTransaction();
        try {
            //Criando usuario
            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
           ]);
            //Comitando a transação
            DB::commit();
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuario cadastrado com sucesso',
            ],201);
        }
        catch (Exception $e) {
            //Desfazendo a transação
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuario',
            ],400);
        }    
       
    }

    //Editar usuario
    public function update(UserRequest $request, $id) : JsonResponse
    {
        //Iniciar transação
        DB::beginTransaction();
        try {
            //editar o registro no banco de dados
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            //Comitar a transação
            DB::commit();
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuario editado com sucesso!',
            ],200);

        } catch(Exception $e){
            //Desfazendo a transação
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erro ao editar usuário'
            ],400);
        }
    }

    //Deletar usuario
    public function destroy($id) : JsonResponse
    {
        try {
            //Deletar o registro no banco de dados
            User::destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Usuario deletado com sucesso!',
            ],200);

        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Erro ao deletar usuário'

            ],400);
        }        
    }
}
