<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comercio;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de Gestión de Comercios
 *
 * Gestiona el registro y panel de control de los comercios
 * que donan alimentos en la plataforma SocialFood.
 *
 * @package App\Http\Controllers
 * @author SocialFood Team
 * @version 1.0
 */
class ComercioController extends Controller
{
    /**
     * Muestra el formulario para completar datos del comercio
     *
     * Restringido a usuarios con rol 'comercio'. Si el usuario no
     * es un comercio, se responde con 403.
     *
     * @return \Illuminate\View\View Vista de registro de comercio
     */
    public function create()
    {
        if (Auth::user()->rol !== 'comercio') {
            abort(403);
        }

        return view('registro-comercio');
    }

    /**
     * Registra un comercio asociado al usuario autenticado
     *
     * Valida los datos del formulario y crea el registro en la tabla
     * `comercios` enlazándolo con el usuario actual. Al finalizar,
     * redirige al listado de donaciones del comercio.
     *
     * @param  \Illuminate\Http\Request $request Datos del formulario
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje de éxito
     * @throws \Illuminate\Validation\ValidationException Si los datos no son válidos
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre_comercial' => 'required|string|max:255',
        'direccion'        => 'nullable|string|max:255',
        'horario'          => 'nullable|string|max:255',
        'activo'           => 'boolean',
    ]);

    Comercio::create([
        'id_usuario'      => Auth::id(),
        'nombre_comercial'=> $request->nombre_comercial,
        'direccion'       => $request->direccion,
        'horario'         => $request->horario,
        'activo'          => $request->has('activo'),
    ]);

    return redirect()->route('donaciones.index')
        ->with('success', 'Comercio registrado correctamente. Ya puedes publicar donaciones.');
}

    /**
     * Muestra el panel del comercio autenticado
     *
     * Restringido a usuarios con rol 'comercio'. Renderiza la vista
     * principal del panel de gestión de comercios.
     *
     * @return \Illuminate\View\View Vista del panel de comercio
     */
    public function panel()
    {
        if (Auth::user()->rol !== 'comercio') {
            abort(403);
        }

        return view('comercio.panel');
    }
   

}