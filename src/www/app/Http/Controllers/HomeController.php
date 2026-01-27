<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador Principal del Sistema
 *
 * Gestiona el dashboard principal y el perfil de usuario
 * del sistema SocialFood.
 *
 * @package App\Http\Controllers
 * @author SocialFood Team
 * @version 1.0
 */
class HomeController extends Controller
{
    /**
     * Constructor del controlador
     *
     * Aplica el middleware de autenticación a todos los métodos
     * del controlador.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el dashboard principal
     *
     * Renderiza la vista home con opciones específicas según
     * el rol del usuario autenticado (comercio, voluntario, ONG).
     *
     * @return \Illuminate\View\View Vista del dashboard
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Muestra el perfil del usuario autenticado
     *
     * Renderiza la vista del perfil donde el usuario puede
     * ver y editar sus datos personales.
     *
     * @return \Illuminate\View\View Vista de perfil
     */
    public function perfil()
    {
        return view('perfil_usuario');
    }

   /**
     * Actualiza los datos del perfil del usuario
     *
     * Valida y guarda los cambios en el nombre, email y opcionalmente
     * la contraseña del usuario autenticado. La contraseña se hashea
     * antes de guardarse.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje de éxito
     * @throws \Illuminate\Validation\ValidationException Si los datos son inválidos
     */
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

    if (!empty($data['password'])) {
        $user->contrasena_hash = Hash::make($data['password']);
    }

    $user->save();

    return redirect()->back()->with('success', 'Perfil actualizado correctamente');
}

}
