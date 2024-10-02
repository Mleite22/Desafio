<?php

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