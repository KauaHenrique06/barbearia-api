<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/showUser', [UserController::class, 'index']);

/**
 * Definição do Endpoint da requisição de cadastrar usuário
 * e chama a classe que contém essa função dentro do Controller 
 */
Route::post('/register/user', [UserController::class, 'store']);

Route::post('/register/client', [ClientController::class, 'store']);