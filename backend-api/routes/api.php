<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Listar usuarios
Route::get('/users', [UserController::class, 'index']); //GET - http://127.0.0.1:8000/api/users?page=1

//Visualizar ususario
Route::get('/users/{id}', [UserController::class, 'show']); //GET - http://127.0.0.1:8000/api/users/1