<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de Registro de Usuarios
 *
 * Gestiona el proceso de registro de nuevos usuarios en el sistema,
 * incluyendo comercios y voluntarios.
 *
 * @package App\Http\Controllers
 * @author SocialFood Team
 * @version 1.0
 */
class RegistroController extends Controller
{
    /**
     * Muestra el formulario de registro de usuario
     *
     * Renderiza la vista para crear una nueva cuenta en el sistema.
     *
     * @return \Illuminate\View\View Vista de registro
     */
    public function showRegister()
    {
        return view('registrar-usuario');
    }

    /**
     * Procesa el registro de un nuevo usuario
     *
     * Valida los datos, crea el usuario con contraseña hasheada y
     * autentica la sesión. Redirige según el tipo de usuario:
     * - comercio: a completar datos del comercio
     * - ong / voluntario: al inicio
     *
     * @param  \Illuminate\Http\Request $request Datos del formulario de registro
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje
     * @throws \Illuminate\Validation\ValidationException Si los datos no son válidos
     */
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
