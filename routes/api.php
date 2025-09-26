<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Definição do Endpoint da requisição de cadastrar usuário
 * e chama a classe que contém essa função dentro do Controller 
 * 
 * OBS: por estar na route 'api.php', na hora de colocar a URL no Apidog
 * colocar /api/<nome-endpoint>
 */
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);