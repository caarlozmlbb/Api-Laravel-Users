<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("v1/estudiantes", EstudianteController::class);
Route::apiResource('api/personas', PersonaController::class);
Route::apiResource('v1/usuarios', UserController::class);
