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
}
