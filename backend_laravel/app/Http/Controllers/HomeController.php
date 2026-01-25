<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function perfil()
    {
        return view('perfil_usuario');
    }

    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $user->id_usuario . ',id_usuario',
            'password' => 'nullable|string|min:6'
        ]);

        $user->nombre = $data['nombre'];
        $user->email = $data['email'];

        if ($data['password']) {
            $user->contrasena_hash = Hash::make($data['password']);
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado correctamente');
    }
}
