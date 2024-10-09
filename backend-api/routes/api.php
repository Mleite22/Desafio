<?php

use App\Http\Controllers\Api\CursoAlunoController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




//Listar usuarios
Route::get('/users', [UserController::class, 'index']); //GET - http://127.0.0.1:8000/api/users?page=1

//Visualizar ususario
Route::get('/users/{id}', [UserController::class, 'show']); //GET - http://127.0.0.1:8000/api/users/1

//Cadastrar ususario
Route::post('/users', [UserController::class, 'store']); //POST - http://127.0.0.1:8000/api/users

//Editar usuario
Route::put('/users/{id}', [UserController::class, 'update']); //PUT - http://127.0.0.1:8000/api/users/1

//Deletar usuario
Route::delete('/users/{id}', [UserController::class, 'destroy']); //DELETE - http://127.0.0.1:8000/api/users/9


//Rotas cursos
Route::get('/curso', [CursoController::class, 'index']); //GET - http://127.0.0.1:8000/api/curso?page=1

//Visualizar Curso
Route::get('/curso/{id}', [CursoController::class, 'show']); //GET - http://127.0.0.1:8000/api/curso/1

//Cadastrar Curso
Route::post('/curso', [CursoController::class, 'store']); //POST - http://127.0.0.1:8000/api/curso

//Editar Curso
Route::put('/curso/{id}', [CursoController::class, 'update']); //PUT - http://127.0.0.1:8000/api/curso/1

//Deletar curso
Route::delete('/curso/{id}', [CursoController::class, 'destroy']); //DELETE - http://127.0.0.1:8000/api/curso/1


//Rota cursoaluno
Route::get('/cursoaluno', [CursoAlunoController::class, 'index']); //GET - http://127.0.0.1:800/api/cursoaluno