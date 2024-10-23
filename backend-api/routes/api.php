<?php

use App\Http\Controllers\Api\CursoAlunoController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware([CorsMiddleware::class])->group(function () {
    
});

//Login
Route::post('/login', [LoginController::class, 'login'])->name('login'); //POST - http://127.0.0.1:8000/api/login

//Rotas restritas
Route::group(['middleware' => ['auth:sanctum']], function () {
    //logout
    //Route::post('/logout/{user}', [LoginController::class, 'logout']); //POST - http://127.0.0.1:8000/api/logout/1
    Route::post('/logout', [LoginController::class, 'logout']); //POST - http://127.0.0.1:8000/api/logout/1

    //Listar usuarios
    Route::get('/users', [UserController::class, 'index']); //GET - http://127.0.0.1:8000/api/users?page=1

    //Visualizar ususario
    Route::get('/users/{id}', [UserController::class, 'show']); //GET - http://127.0.0.1:8000/api/users/1
    //Route::get('/users/show', [UserController::class, 'show']); //GET - http://127.0.0.1:8000/api/users/1

    //Editar usuario
    Route::put('/users/{id}', [UserController::class, 'update']); //PUT - http://127.0.0.1:8000/api/users/1

    //Deletar usuario
    Route::delete('/users/{id}', [UserController::class, 'destroy']); //DELETE - http://127.0.0.1:8000/api/users/9


    //Rotas cursos
    //Route::get('/curso', [CursoController::class, 'index']); //GET - http://127.0.0.1:8000/api/curso?page=1

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

    //Matricular usuario em um curso
    Route::post('/cursoaluno', [CursoAlunoController::class, 'store']); // POST - http://127.0.0.1:8000/api/cursoaluno

    Route::get('/cursoaluno/{curso_Id}', [CursoAlunoController::class, 'show']);
});

//Cadastrar ususario
Route::post('/users', [UserController::class, 'store']); //POST - http://127.0.0.1:8000/api/users

//Rotas cursos
Route::get('/curso', [CursoController::class, 'index']); //GET - http://127.0.0.1:8000/api/curso?page=1

