<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    public function index(): JsonResponse
    {
        //Recuperando curso do banco
        $curso = Curso::with('modcurso')->orderBy('id', 'Asc')->paginate(2);
        //Recuperando modalidade do curso do banco
        $formattedCursos = $curso->getCollection()->map(function ($curso) {
            return response()->json([
                'status' => true,
                'id' => $curso->id,
                'nome' => $curso->nome_curso,
                'descricao' => $curso->descricao_curso,
                'modalidade' => $curso->modcurso->nome,
            ]);
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

    //Cadatrar curso
    public function store(CursoRequest $request): JsonResponse
    {

        //Iniciar a transação
        DB::beginTransaction();

        try {

            //Criando curso
            $curso = Curso::create([
                'nome_curso' => $request->nome_curso,
                'descricao_curso' => $request->descricao_curso,
                'modcurso_id' => $request->modcurso_id
            ]);
            //Comitando atransação
            DB::commit();
            //Retornando curso
            return response()->json([
                'status' => true,
                'message' => 'Curso Cadastrado com sucesso!',
                'curso' => [
                    'nome_curso' => $curso->nome_curso,
                    'descricao_curso' => $curso->descricao_curso,
                    'modcurso_id' => $curso->modcurso->nome,
                ]
            ], 201);
        } catch (Exception $e) {
            //Desfazendo a transação
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar Curso',
            ], 400);
        }
    }

    //Editar cusro
    public function update(CursoRequest $request, $id): JsonResponse
    {
        //Iniciar a transação
        DB::beginTransaction();
        try {
            //Atualizando curso
            $curso = Curso::find($id);
            $curso->update([
                'nome_curso' => $request->nome_curso,
                'descricao_curso' => $request->descricao_curso,
                'modcurso_id' => $request->modcurso_id
            ]);
            //Comitando a transação
            DB::commit();
            //Retornando curso
            return response()->json([
                'status'  => true,
                'message' => 'Curso Atualizado com sucesso!',
                'curso' => [
                    'nome_curso'  => $curso->nome_curso,
                    'descricao_curso' => $curso->descricao_curso,
                    'modcurso_id' => $curso->modcurso->nome,
                ]
            ], 200);
        } catch (Exception $e) {
            //Desfazendo a transação
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'message' => 'Erro ao atualizar Curso',
            ], 400);
        }
    }

    //Deletar curso
    public function destroy($id): JsonResponse
    {
        try {
            //Deletando curso
            Curso::destroy($id);
            return response()->json([
                'status'  => true,
                'message' => 'Curso deletado com sucesso!',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Erro ao deletar curso',
            ], 400);
        }
    }
}
