<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\DonacionController;
use App\Http\Controllers\HomeController;

// Redirigir raíz a login
Route::get('/', fn() => redirect()->route('login'));

// =========================
// AUTENTICACIÓN
// =========================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [RegistroController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegistroController::class, 'registrar']);

    Route::get('/password/reset', [AuthController::class, 'showForgot'])->name('password.request');
    Route::post('/password/reset', [AuthController::class, 'recuperarPassword'])->name('password.email');
});

// =========================
// RUTAS PROTEGIDAS
// =========================
Route::middleware('auth')->group(function () {

    // HOME Y PERFIL
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/perfil', [HomeController::class, 'perfil'])->name('perfil');
    Route::put('/perfil', [HomeController::class, 'actualizarPerfil'])->name('perfil.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // COMERCIO
    Route::get('/comercio/crear', [ComercioController::class, 'create'])->name('comercio.create');
    Route::post('/comercio', [ComercioController::class, 'store'])->name('comercio.store');

    // DONACIONES CUSTOM
    Route::get('/donaciones/disponibles', [DonacionController::class, 'disponibles'])->name('donaciones.disponibles');
    Route::get('/historial-voluntario', [DonacionController::class, 'historialVoluntario'])->name('historial.voluntario');
    Route::get('/donaciones/en-camino', [DonacionController::class, 'enCamino'])->name('donaciones.en-camino');
    Route::get('/historial-ong', [DonacionController::class, 'historialOng'])->name('historial.ong');
    Route::post('/donaciones/{id}/aceptar', [DonacionController::class, 'aceptar'])->name('donaciones.aceptar');

    // CRUD DONACIONES
    Route::resource('donaciones', DonacionController::class);
});
