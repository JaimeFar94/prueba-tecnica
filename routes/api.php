<?php

use App\Models\Companie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\companieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Ver todas las empresas
Route::get('/companies', [companieController::class, 'index']);

//Ver una empresa en especifico
Route::get('/companies/{id}', [companieController::class, 'show']);

//Enviar la información de una empresa
Route::post('/companies', [companieController::class, 'store']);

//Actualizar la información de una empresa
Route::put('/companies/{id}', [companieController::class, 'update']);

//Actualizar parcialmente la información de una empresa
Route::patch('/companies/{id}', [companieController::class, 'updatePartial']);

//Eliminar una Empresa
Route::delete('/companies/{id}', [companieController::class, 'destroy']);