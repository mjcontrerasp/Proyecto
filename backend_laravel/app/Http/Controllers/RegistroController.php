<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function showRegister()
    {
        return view('registrar-usuario');
    }

    public function registrar(Request $request)
{
    $data = $request->validate([
        'nombre'       => 'required|string|max:100',
        'email'        => 'required|email|unique:usuarios,email',
        'telefono'     => 'required|string|max:20',
        'tipo_usuario' => 'required|in:comercio,voluntario,ong',
        'password'     => 'required|string|min:4|confirmed',
    ]);

    $usuario = User::create([
        'nombre'          => $data['nombre'],
        'email'           => $data['email'],
        'telefono'        => $data['telefono'],
        'contrasena_hash' => Hash::make($data['password']),
        'rol'             => $data['tipo_usuario'],
    ]);

    Auth::login($usuario);

    // 👉 Comercio: primero completa datos
    if ($data['tipo_usuario'] === 'comercio') {
        return redirect()->route('comercio.create')
            ->with('success', 'Ahora completa los datos de tu comercio');
    }

    // 👉 ONG
    if ($data['tipo_usuario'] === 'ong') {
        return redirect()->route('home')
            ->with('success', 'Bienvenido ONG');
    }

    // 👉 Voluntario
    return redirect()->route('home')
        ->with('success', 'Registro completado correctamente');
}

}
