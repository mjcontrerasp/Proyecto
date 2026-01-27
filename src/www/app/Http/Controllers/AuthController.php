<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;   
use Illuminate\Support\Facades\Hash;
/**
 * Controlador de Autenticación
 *
 * Gestiona el login, logout y recuperación de contraseñas
 * de usuarios del sistema SocialFood.
 *
 * @package App\Http\Controllers
 * @author SocialFood Team
 * @version 1.0
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión
     *
     * Renderiza la vista de login para que los usuarios
     * puedan autenticarse en el sistema.
     *
     * @return \Illuminate\View\View Vista de login
     */
    public function showLogin()
    {
        return view('index');
    }

    /**
     * Procesa el inicio de sesión del usuario
     *
     * Valida las credenciales y redirige según el rol del usuario:
     * - comercio: a mis donaciones
     * - voluntario: a donaciones disponibles
     * - ong: al home
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario de login
     * @return \Illuminate\Http\RedirectResponse Redirección según rol
     * @throws \Illuminate\Validation\ValidationException Si las credenciales son inválidas
     */
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
    return redirect()->route('donaciones.disponibles');
}

            if ($rol === 'ong') {
            return redirect()->route('home'); // o una ruta ONG cuando la tengas
            }

            return redirect()->route('home');
        }

        return back()->with('error', 'Credenciales inválidas');
    }

    /**
     * Cierra la sesión del usuario autenticado
     *
     * Invalida la sesión actual y regenera el token CSRF
     * para prevenir ataques de seguridad.
     *
     * @param  \Illuminate\Http\Request  $request Petición HTTP
     * @return \Illuminate\Http\RedirectResponse Redirección al login
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Muestra el formulario de recuperación de contraseña
     *
     * Renderiza la vista para que los usuarios puedan solicitar
     * un enlace de recuperación de contraseña.
     *
     * @return \Illuminate\View\View Vista de recuperación
     */
    public function showForgot()
    {
        return view('recuperar-contrasena');
    }

    /**
     * Procesa la solicitud de recuperación de contraseña
     *
     * Envía un email con el enlace de recuperación al usuario.
     * Actualmente en construcción.
     *
     * @param  \Illuminate\Http\Request  $request Email del usuario
     * @return \Illuminate\Http\RedirectResponse Mensaje de confirmación
     * @todo Implementar envío de email de recuperación
     */
    public function recuperarPassword(Request $request)
    {
        $request->validate([
        'email' => 'required|email'
    ]);

    $usuario = User::where('email', $request->email)->first();

    if (!$usuario) {
        return back()->with('error', 'No existe ningún usuario con ese correo.');
    }

    // Generamos una nueva contraseña cutre
    $nuevaPassword = 'sf' . rand(1000, 9999);

    // La guardamos hasheada
    $usuario->contrasena_hash = Hash::make($nuevaPassword);
    $usuario->save();

    // Mostramos la nueva contraseña en pantalla
    return back()->with([
        'success'  => 'Se ha generado una nueva contraseña.',
        'password' => $nuevaPassword
    ]);
    }
}
