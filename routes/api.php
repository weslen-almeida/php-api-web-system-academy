<?php

use App\Http\Controllers\Api\Login\LoginController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

// Rota Publica
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');

// Definir a regra de como será implementado a criação do usuario
// Se somente o Adm cria ou ele pode se cadastrar
Route::post('/create', [UserController::class, 'create']);

// Rota Privada
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/user', [UserController::class, 'all']);
    Route::post('/logout/{user}', [LoginController::class, 'logout']);
});
