<?php

use App\Http\Controllers\Api\CursoAlunoController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RecoverPasswordCodeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Login
Route::post('/login', [LoginController::class, 'login'])->name('login'); //POST - http://127.0.0.1:8000/api/login


//Rotas restritas
Route::group(['middleware' => ['auth:sanctum']], function () {

    //logout
    Route::post('/logout', [LoginController::class, 'logout']);

   // Rotas de Usuários
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::patch('/profile', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // Rotas de Cursos
    Route::prefix('curso')->group(function () {
        Route::get('/{id}', [CursoController::class, 'show']);
        Route::post('/', [CursoController::class, 'store']);
        Route::put('/{id}', [CursoController::class, 'update']);
        Route::delete('/{id}', [CursoController::class, 'destroy']);
    });

    // Rotas de Curso Aluno
    Route::prefix('cursoaluno')->group(function () {
        Route::get('/', [CursoAlunoController::class, 'index']);
        Route::post('/', [CursoAlunoController::class, 'store']);
        Route::get('/{curso_Id}', [CursoAlunoController::class, 'show']);
    });
});

//Cadastrar usuário
Route::post('/users', [UserController::class, 'store']); //POST - http://127.0.0.1:8000/api/users

//Rotas cursos
Route::get('/curso', [CursoController::class, 'index']); //GET - http://127.0.0.1:8000/api/curso?page=1

// Recuperar senha
Route::post("/forgot-password-code", [RecoverPasswordCodeController::class, 'forgotPasswordCode']);
Route::post("/reset-password-validate-code", [RecoverPasswordCodeController::class, 'resetPasswordValidateCode']);
Route::post("/reset-password-code", [RecoverPasswordCodeController::class, 'resetPasswordCode']);