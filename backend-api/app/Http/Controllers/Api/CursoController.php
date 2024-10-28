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
        // Recuperando curso do banco
        $curso = Curso::with('modcurso')->orderBy('id', 'Asc')->paginate(3);

        // Formatando os cursos com suas modalidades
        $formattedCursos = $curso->getCollection()->map(function ($curso) {
            return [
                'id' => $curso->id,
                'nome' => $curso->nome_curso,
                'descricao' => $curso->descricao_curso,
                'modalidade' => $curso->modcurso->nome,
                'imagem' => $curso->imagem
            ];
        });

        // Retornando os cursos formatados
        return response()->json([
            'status' => true,
            'curso' => $formattedCursos,
            'pagination' => [
                'current_page' => $curso->currentPage(),
                'last_page' => $curso->lastPage(),
                'total' => $curso->total(),
            ],
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
                'imagem' => $curso->imagem,
            ]

        ], 200);
    }

    //Cadatrar curso
    public function store(CursoRequest $request): JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();

        try {
            $cursoData = [
                'nome_curso' => $request->nome_curso,
                'descricao_curso' => $request->descricao_curso,
                'modcurso_id' => $request->modcurso_id,
            ];

            // Verifica se uma imagem foi enviada
            if ($request->hasFile('imagem')) {
                $cursoData['imagem'] = $request->file('imagem')->store('imagens', 'public'); // Armazena a imagem se fornecida
            }

            // Criando curso
            $curso = Curso::create($cursoData);
            // Comitando a transação
            DB::commit();
            // Retornando curso
            return response()->json([
                'status' => true,
                'message' => 'Curso Cadastrado com sucesso!',
                'curso' => [
                    'nome_curso' => $curso->nome_curso,
                    'descricao_curso' => $curso->descricao_curso,
                    'modcurso_id' => $curso->modcurso->nome,
                    'imagem' => $curso->imagem, // Incluindo o campo imagem na resposta
                ]
            ], 201);
        } catch (Exception $e) {
            // Desfazendo a transação
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar Curso',
            ], 400);
        }
    }

    // Editar curso
    public function update(CursoRequest $request, $id): JsonResponse
    {
        // Iniciar a transação
        DB::beginTransaction();
        try {
            // Encontrar o curso
            $curso = Curso::find($id);
            if (!$curso) {
                return response()->json([
                    'status' => false,
                    'message' => 'Curso não encontrado',
                ], 404);
            }

            $cursoData = [
                'nome_curso' => $request->nome_curso,
                'descricao_curso' => $request->descricao_curso,
                'modcurso_id' => $request->modcurso_id,
            ];

            // Verifica se uma nova imagem foi enviada
            if ($request->hasFile('imagem')) {
                $cursoData['imagem'] = $request->file('imagem')->store('imagens', 'public'); // Atualiza a imagem se fornecida
            }

            // Atualiza o curso com os dados
            $curso->update($cursoData);
            // Comitando a transação
            DB::commit();
            // Retornando curso
            return response()->json([
                'status' => true,
                'message' => 'Curso Atualizado com sucesso!',
                'curso' => [
                    'id' => $curso->id,
                    'nome_curso' => $curso->nome_curso,
                    'descricao_curso' => $curso->descricao_curso,
                    'modcurso_id' => $curso->modcurso->nome,
                    'imagem' => $curso->imagem, // Incluindo o campo imagem na resposta
                ]
            ], 200);
        } catch (Exception $e) {
            // Desfazendo a transação
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar Curso',
            ], 400);
        }
    }
}
