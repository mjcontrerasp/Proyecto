<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comercio;
use Illuminate\Support\Facades\Auth;

class ComercioController extends Controller
{
    public function create()
    {
        if (Auth::user()->rol !== 'comercio') {
            abort(403);
        }

        return view('registro-comercio');
    }

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

    public function panel()
    {
        if (Auth::user()->rol !== 'comercio') {
            abort(403);
        }

        return view('comercio.panel');
    }
   

}