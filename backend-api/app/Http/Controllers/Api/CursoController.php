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
        $curso = Curso::orderBy('id', 'Asc')->paginate(2);
        //Recuperando modalidade do curso do banco
        $modalidade = ModalCurso::all();
        //Retorna os cursos
        return response()->json([
            'status' => true,
            'curso' => $curso,
            'nome' => $modalidade,
        ], 200);
    }

    //Visualizar Curso
    public function show($id): JsonResponse
    {
        //Recuperando curso do banco
        $curso = Curso::find($id);
        //Recuperando modalidade do curso do banco
        $modalidade = ModalCurso::find($id);
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
            'curso' => $curso,
            'nome' => $modalidade,

        ], 200);
    }
}
