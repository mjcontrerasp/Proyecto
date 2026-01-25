<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donacion;
use Auth;

class DonacionController extends Controller
{
    /**
     * Mostrar lista de donaciones del usuario
     */
    public function index()
    {
        $donaciones = Donacion::where('id_usuario', Auth::id())->get();
        return view('donaciones.index', ['donaciones' => $donaciones]);

    }

    /**
     * Mostrar formulario de crear donación
     */
    public function create()
{
    return view('donaciones.create');
}


    /**
     * Guardar nueva donación
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
    'tipo_comida'    => 'required|string',
    'cantidad'       => 'required|numeric|min:0.1',
    'fecha_hora'     => 'required|date',
    'punto_recogida' => 'required|string',
    'estado'         => 'required|string',
    'observaciones'  => 'nullable|string',
    'foto'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
]);
        $validated['id_usuario'] = Auth::id();
        

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('donaciones', 'public');
        }

        Donacion::create($validated);

        return redirect()->route('donaciones.index')->with('success', 'Donación publicada correctamente');
    }

    /**
     * Mostrar detalle de donación
     */
    public function show($id)
    {
        $donacion = Donacion::findOrFail($id);
        return view('detalle-donacion-comerio', ['donacion' => $donacion]);
    }

    /**
     * Mostrar formulario de editar
     */
    public function edit($id)
{
    $donacion = Donacion::findOrFail($id);
    return view('donaciones.form', compact('donacion'));
}

    /**
     * Actualizar donación
     */
    public function update(Request $request, $id)
    {
        $donacion = Donacion::findOrFail($id);

        $validated = $request->validate([
    'tipo_comida'    => 'required|string',
    'cantidad'       => 'required|numeric|min:0.1',
    'fecha_hora'     => 'required|date',
    'punto_recogida' => 'required|string',
    'estado'         => 'required|string',
    'observaciones'  => 'nullable|string',
    'foto'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
]);


        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('donaciones', 'public');
        }

        $donacion->update($validated);

        return redirect()->route('donaciones.index')->with('success', 'Donación actualizada correctamente');
    }

    /**
     * Eliminar donación
     */
    public function destroy($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->delete();

        return redirect()->route('donaciones.index')->with('success', 'Donación eliminada correctamente');
    }

    /**
     * Marcar donación como recogida
     */
    public function recoger($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->update(['estado' => 'Recogida']);
        return redirect()->back()->with('success', 'Marcada como recogida correctamente');
    }

    /**
     * Marcar donación como entregada
     */
    public function entregar($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->update(['estado' => 'Entregada']);
        return redirect()->back()->with('success', 'Marcada como entregada correctamente');
    }

    /**
     * Confirmar recogida de donación
     */
    public function confirmar($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->update(['estado' => 'Recogida confirmada']);
        return redirect()->back()->with('success', 'Recogida confirmada correctamente');
    }

    /**
     * Voluntario acepta donación
     */
    public function aceptar($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->update([
            'id_voluntario_asignado' => Auth::id(),
            'estado' => 'Asignada'
        ]);
        return redirect()->back()->with('success', 'Donación aceptada correctamente');
    }

    /**
     * Confirmar recepción en ONG
     */
    public function confirmarRecepcion($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->update(['estado' => 'Entregada a ONG']);
        return redirect()->back()->with('success', 'Recepción confirmada');
    }

    /**
     * Donaciones disponibles para voluntarios
     */
    public function disponibles()
    {
        $donaciones = Donacion::where('estado', 'No asignada')->get();
        return view('donaciones_disponibles', ['donaciones' => $donaciones]);
    }

    /**
     * Donaciones en camino (ONG)
     */
    public function enCamino()
    {
        $donaciones = Donacion::where('estado', 'En camino')->orWhere('estado', 'Asignada')->get();
        return view('donaciones.en_camino', ['donaciones' => $donaciones]);

    }

    /**
     * Historial ONG
     */
    public function historialOng()
    {
        $donaciones = Donacion::where('estado', 'Entregada a ONG')->get();
        return view('historial_ong', ['donaciones' => $donaciones]);
    }

    /**
     * Historial Voluntario
     */
    public function historialVoluntario()
    {
        $donaciones = Donacion::where('id_voluntario_asignado', Auth::id())->get();
        return view('historial_voluntario', ['donaciones' => $donaciones]);
    }
}
