<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\ModalCurso;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(): JsonResponse
    {
        //Recuperando curso do banco
        $curso = Curso::with('modcurso')->orderBy('id', 'Asc')->paginate(2);
        //Recuperando modalidade do curso do banco
        // $modalidade = ModalCurso::all();
        $formattedCursos = $curso->map(function($curso){
            return [
                'id' => $curso->id,
                'nome' => $curso->nome_curso,
                'descricao' => $curso->descricao_curso,
                'modalidade' => $curso->modcurso->nome,                                
            ];
        });

        //Retorna os cursos
        return response()->json([
            'status' => true,
            'curso' => $formattedCursos,
        ], 200);
    }

    //Visualizar Curso
    public function show($id): JsonResponse
    {
        //Recuperando curso do banco
        $curso = Curso::with('modcurso')->find($id);        
        //Verificando se o curso existe
        if (!$curso) {
            return response()->json([
                'status' => false,
                'message' => 'Curso não encontrado',
            ], 400);
        }
        //Retorna o curso
        return response()->json([
            'status' => true,
            'curso' => [
                'id' => $curso->id,
                'nome' => $curso->nome_curso,
                'descricao' => $curso->descricao_curso,
                'modalidade' => $curso->modcurso->nome, 
            ]

        ], 200);
    }
}
