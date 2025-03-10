<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\CursoAluno;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CursoAlunoController extends Controller
{

    public function index(): JsonResponse
    {
        // Obtém o usuário autenticado
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuário não autenticado.',
            ], 401); // Não autorizado
        }

        // Recuperar os cursos em que o usuário está matriculado
        $cursoAlunos = CursoAluno::where('user_id', $user->id)
            ->with('curso')
            ->get();

        return response()->json([
            'status' => true,
            'cursoAlunos' => $cursoAlunos->map(function ($cursoAluno) {
                return [
                    'id' => $cursoAluno->id,
                    'curso' => [
                        'id' => $cursoAluno->curso_id,
                        'nome' => Curso::find($cursoAluno->curso_id)->nome_curso,
                        'nome_user' => User::find($cursoAluno->user_id)->name,
                        'descricao' => Curso::find($cursoAluno->curso_id)->descricao_curso
                    ],
                ];
            }),
        ], 200);
    }


    //Matricular aluno
    public function store(Request $request): JsonResponse
    {
        // Validar a requisição
        $request->validate([
            'curso_id' => 'required|exists:curso,id',
        ]);

        // Obter o usuário autenticado
        $user = Auth::user();

        // Verificar se o usuário já está inscrito no curso
        $existingEnrollment = CursoAluno::where('user_id', $user->id)
            ->where('curso_id', $request->curso_id)
            ->first();

        if ($existingEnrollment) {
            return response()->json([
                'status' => false,
                'message' => 'Você já está inscrito neste curso.',
            ], 400);
        }

        // Criar a matrícula
        $cursoAluno = CursoAluno::create([
            'curso_id' => $request->curso_id,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Inscrição realizada com sucesso!',
        ], 201);
    }

    public function show($cursoId): JsonResponse
    {
        // Obtém o usuário autenticado
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuário não autenticado.',
            ], 401); // Não autorizado
        }

        // Verifica se o usuário está matriculado no curso
        $inscrito = CursoAluno::where('user_id', $user->id)
            ->where('curso_id', $cursoId)
            ->exists();

        return response()->json([
            'inscrito' => $inscrito,
        ], 200);
    }

}
