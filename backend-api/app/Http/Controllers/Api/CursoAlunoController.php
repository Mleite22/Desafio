<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\CursoAluno;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class CursoAlunoController extends Controller
{
    public function index(): JsonResponse
    {
        //Recupera Usuario que estão matriculados em algum curso
        $cursoAlunos = CursoAluno::with('curso', 'users')->orderBy('id', 'DESC')->paginate(2);

        return response()->json([
            'status' => true,
            'cursoAlunos' => $cursoAlunos->map(function ($cursoAluno) {
                return [
                    'id' => $cursoAluno->id,
                    'curso' => [
                        'id' => $cursoAluno->curso_id,
                        'nome' => Curso::find($cursoAluno->curso_id)->nome_curso,
                    ],
                    'users' => [
                        'id' => $cursoAluno->user_id,
                        'name' => User::find($cursoAluno->user_id)->name,
                    ],
                ];
            }),
        ], 200);
    }

    //Matricular usuario em um curso
    public function store($idCurso): JsonResponse
    {
        // Obtém o usuário autenticado
        $usuario = auth()->user();
        if (!$usuario) {
            return response()->json([
                'status' => false,
                'message' => 'Usuário não autenticado.',
            ], 401); // Não autorizado
        }

        // Verifica se o curso existe
        $curso = Curso::find($idCurso);
        if (!$curso) {
            return response()->json([
                'status' => false,
                'message' => 'Curso não encontrado.',
            ], 404);
        }

        // Verifica se o usuário já está matriculado no curso
        $existingMatricula = CursoAluno::where('curso_id', $idCurso)->where('user_id', $usuario->id)->first();
        if ($existingMatricula) {
            return response()->json([
                'status' => false,
                'message' => 'Usuário já está matriculado neste curso.',
            ], 409); // Conflito
        }

        // Cria a nova matrícula
        $cursoAluno = new CursoAluno();
        $cursoAluno->curso_id = $idCurso;
        $cursoAluno->user_id = $usuario->id; // Usa o ID do usuário autenticado
        $cursoAluno->save();

        return response()->json([
            'status' => true,
            'message' => 'Matrícula realizada com sucesso!',
            'matricula' => [
                'id' => $cursoAluno->id,
                'curso' => [
                    'id' => $cursoAluno->curso_id,
                    'nome' => $curso->nome_curso,
                ],
                'users' => [
                    'id' => $cursoAluno->user_id,
                    'name' => $usuario->name,
                ],
            ],
        ], 201);
    }
}
