<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CampoController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\CitaController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('campos', CampoController::class);
Route::apiResource('medicos', MedicoController::class);
Route::apiResource('pacientes', PacienteController::class);
Route::apiResource('citas', CitaController::class);