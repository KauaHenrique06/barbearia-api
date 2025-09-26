<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Definição do Endpoint da requisição de cadastrar usuário
 * e chama a classe que contém essa função dentro do Controller 
 * 
 * OBS: por estar na route 'api.php' e ter um prefixo para padronizar a rota, na hora de colocar a URL no Apidog
 * colocar /api/auth/<nome-endpoint>
 * Exemplo: http://127.0.0.1:8000/api/auth/login 
 */

Route::prefix('auth', function(){

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::prefix('schedule', function() {

    Route::post('/create', [ScheduleController::class, 'create']);

    Route::get('/show', [ScheduleController::class, 'show']); //falta criar a lógica
});

Route::post('teste', [ClientController::class, 'teste']);
