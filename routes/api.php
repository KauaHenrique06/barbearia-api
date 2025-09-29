<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserTypeController;
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

Route::prefix('auth')->group(function() {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout']);

});

/**
 * as rotas com o middleware() faz com que seja necessário passar o token gerado após o login para
 * conseguir ter acesso a essas funcionalidades
 */
Route::prefix('userType')->group(function() {

    Route::post('/create', [UserTypeController::class, 'create'])->middleware('auth:sanctum');

    Route::get('/showTypes', [UserTypeController::class, 'show'])->middleware('auth:sanctum');

    Route::delete('/delete/{id}', [UserTypeController::class, 'delete'])->middleware('auth:sanctum');

    Route::put('/update/{id}', [UserTypeController::class, 'update'])->middleware('auth:sanctum');

});

Route::prefix('client')->group(function() {

    Route::post('create', [ClientController::class, 'create'])->middleware('auth:sanctum');

    Route::get('show/{id}', [ClientController::class, 'show'])->middleware('auth:sanctum');

    Route::get('showAll', [ClientController::class, 'showAll'])->middleware('auth:sanctum');

    Route::put('/update/{id}', [ClientController::class, 'update'])->middleware('auth:sanctum'); 

    Route::delete('delete/{id}', [ClientController::class, 'delete'])->middleware('auth:sanctum'); 

});

Route::prefix('schedule')->group(function() {

    Route::post('/create', [ScheduleController::class, 'create']);

    #nessa rota eu posso procurar por um agendamento em especifico baseado no ID
    Route::get('/show/{id}', [ScheduleController::class, 'show'])->middleware('auth:sanctum');

    #ja nessa eu posso listar todos os agendamentos disponiveis
    Route::get('/show', [ScheduleController::class, 'showAll'])->middleware('auth:sanctum');

    Route::delete('delete/{id}', [ScheduleController::class, 'delete'])->middleware('auth:sanctum');

});



