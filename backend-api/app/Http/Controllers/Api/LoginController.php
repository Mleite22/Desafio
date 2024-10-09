<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Login
    public function login(Request $request) : JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            if ($user) {
                $token = $user->createToken('api_token')->plainTextToken;
                return response()->json([
                    'status' => true,
                    'token' =>$token,
                    'user' => $user,
                    'message' => 'Logado com sucesso!'
                ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Falha ao recuperar usuário'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login ou senha incorreta'
            ], 404);
        }

    }
}
