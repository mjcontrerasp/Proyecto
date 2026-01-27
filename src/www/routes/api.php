<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Models\Usuario;

Route::get('/test-db', function () {
    return Usuario::with('comercios')->get();
});
use App\Http\Controllers\ComercioController;

Route::post('/comercios', [ComercioController::class, 'registrar']);

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

use App\Http\Controllers\RegistroController;

Route::post('/registro', [RegistroController::class, 'registrar']);



Route::get('/debug-usuarios', function () {
    return Usuario::all();
});

