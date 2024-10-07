<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CursoAluno;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CursoAlunoController extends Controller
{
    public function index() : JsonResponse
    {
        //Recupera Usuario que estão matriculados em algum curso
        $cursoAluno = CursoAluno::with('curso', 'users')->orderBy('id', 'ASC')->paginate(2);

        $formatCursoAluno = $cursoAluno->getCollection()->map(function($cursoAluno){
            return response()->json([
                'status' => true,
                'id' => $cursoAluno->id,
                'curso' => [
                   'id' => $cursoAluno->curso_id,
                   'nome' => $cursoAluno->curso->nome_curso,
                ],
                'users' => [
                    'id' =>$cursoAluno->users->id,
                    'name' => $cursoAluno->users->name
                    ]
            ]);
        }); 
        //Retorna os User matriculados
        return response()->json([
            'status' => true,
            'cursoAluno' => $formatCursoAluno
            ], 200);
    }
}
