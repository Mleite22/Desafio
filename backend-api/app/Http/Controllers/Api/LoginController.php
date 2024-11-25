<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //Login
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user) {                
                $token = $user->createToken('api_token')->plainTextToken;
                return response()->json([
                    'status' => true,
                    'token' => $token,
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
    //Logout
    public function logout(): JsonResponse
    {
        try {
            // Pega o usuário autenticado via Sanctum
            $user = Auth::user();
             // Apaga todos os tokens do usuário autenticado
            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Deslogado com sucesso!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao sair do login'
            ], 400);
        }
    }
}
