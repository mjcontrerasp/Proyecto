<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ])) {
            $request->session()->regenerate();

            $rol = Auth::user()->rol;

            if ($rol === 'comercio') {
            return redirect()->route('donaciones.index');
            }

            if ($rol === 'voluntario') {
                return redirect()->route('voluntario.donaciones');
            }
            if ($rol === 'ong') {
            return redirect()->route('home'); // o una ruta ONG cuando la tengas
            }

            return redirect()->route('home');
        }

        return back()->with('error', 'Credenciales inválidas');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showForgot()
    {
        return view('recuperar-contrasena');
    }

    public function recuperarPassword(Request $request)
    {
        return back()->with('status', 'Función en construcción 😅');
    }
}
