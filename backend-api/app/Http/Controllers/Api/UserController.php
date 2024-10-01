<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $users = User::orderBy('id', 'DESC')->paginate(2);
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
        //Verificando se o usuario existe
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario não encontrado',
                
            ]);
        }
        //Retornando usuario
        return response()->json([
            'status' => true,
            'user' => $user,

        ],200);
    }
}
