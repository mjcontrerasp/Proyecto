<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Donacion;
use Auth;

/**
 * Controlador de Gestión de Donaciones
 *
 * Gestiona el ciclo completo de las donaciones de alimentos:
 * creación, asignación, recogida, transporte y entrega.
 * Implementa la lógica de negocio para comercios, voluntarios y ONGs.
 *
 * @package App\Http\Controllers
 * @author SocialFood Team
 * @version 1.0
 */
class DonacionController extends Controller
{
    /**
     * Muestra la lista de donaciones del usuario autenticado
     *
     * Obtiene todas las donaciones creadas por el comercio autenticado,
     * incluyendo la relación con el voluntario asignado.
     *
     * @return \Illuminate\View\View Vista con lista de donaciones
     */
    public function index()
{
    $donaciones = Donacion::where('id_usuario', auth()->user()->id_usuario) // ✅ usar id_usuario
        ->with('voluntario') // carga relación voluntario
        ->get();

    return view('donaciones.index', compact('donaciones'));
}


    /**
     * Muestra el formulario para crear una nueva donación
     *
     * Renderiza la vista del formulario donde el comercio puede
     * registrar un nuevo excedente de alimentos para donación.
     *
     * @return \Illuminate\View\View Vista del formulario de creación
     */
    public function create()
{
    return view('donaciones.create');
}


    /**
     * Guarda una nueva donación en la base de datos
     *
     * Valida los datos del formulario, asocia la donación al usuario autenticado,
     * almacena la foto si fue subida y establece el estado inicial.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario
     * @return \Illuminate\Http\RedirectResponse Redirección a lista de donaciones
     * @throws \Illuminate\Validation\ValidationException Si los datos son inválidos
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
     * Muestra el detalle completo de una donación específica
     *
     * Obtiene los datos completos de una donación incluyendo
     * información del comercio, voluntario y estado actual.
     *
     * @param  int  $id ID de la donación
     * @return \Illuminate\View\View Vista con detalle de la donación
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
     */
    public function show($id)
    {
        $donacion = Donacion::findOrFail($id);
        return view('detalle-donacion-comerio', ['donacion' => $donacion]);
    }

    /**
     * Muestra el formulario para editar una donación existente
     *
     * Obtiene los datos de la donación y renderiza el formulario
     * pre-llenado para que el comercio pueda modificarla.
     *
     * @param  int  $id ID de la donación
     * @return \Illuminate\View\View Vista del formulario de edición
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
     */
    public function edit($id)
{
    $donacion = Donacion::findOrFail($id);
    return view('donaciones.form', compact('donacion'));
}

    /**
     * Actualiza una donación existente en la base de datos
     *
     * Valida los datos modificados, actualiza la foto si fue cambiada
     * y guarda los cambios en la donación.
     *
     * @param  \Illuminate\Http\Request  $request Datos del formulario
     * @param  int  $id ID de la donación
     * @return \Illuminate\Http\RedirectResponse Redirección a lista de donaciones
     * @throws \Illuminate\Validation\ValidationException Si los datos son inválidos
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
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
     * Elimina una donación de la base de datos
     *
     * Elimina permanentemente una donación. Solo el comercio
     * que la creó puede eliminarla.
     *
     * @param  int  $id ID de la donación
     * @return \Illuminate\Http\RedirectResponse Redirección a lista con mensaje
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
     */
    public function destroy($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->delete();

        return redirect()->route('donaciones.index')->with('success', 'Donación eliminada correctamente');
    }

    /**
     * Marca una donación como recogida por el voluntario
     *
     * Verifica que el voluntario autenticado es quien tiene asignada
     * la donación, valida la ONG de destino y actualiza el estado.
     *
     * @param  \Illuminate\Http\Request  $request ID de la ONG destino
     * @param  int  $id ID de la donación
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje
     * @throws \Illuminate\Validation\ValidationException Si la ONG no existe
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
     */
    public function recoger(Request $request, $id)
{
    $donacion = Donacion::findOrFail($id);

    if($donacion->id_voluntario_asignado !== auth()->id()) {
        return redirect()->back()->with('error', 'No tienes permiso para recoger esta donación.');
    }

    $request->validate([
        'id_ong_destino' => 'required|exists:usuarios,id_usuario',
    ]);

    $donacion->update([
        'estado' => 'Recogida',
        'id_ong_destino' => $request->id_ong_destino
    ]);

    return redirect()->back()->with('success', 'Donación marcada como recogida correctamente.');
}



    /**
     * Marca una donación como entregada a la ONG
     *
     * Cambia el estado de la donación a 'Entregada' cuando el
     * voluntario completa la entrega en la ONG destino.
     *
     * @param  int  $id ID de la donación
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje de éxito
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
     */
    public function entregar($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->update(['estado' => 'Entregada']);
        return redirect()->back()->with('success', 'Marcada como entregada correctamente');
    }

    /**
     * Confirma la recogida de la donación por parte del comercio
     *
     * Permite al comercio confirmar que el voluntario ha recogido
     * exitosamente los alimentos de su establecimiento.
     *
     * @param  int  $id ID de la donación
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
     */
    public function confirmar($id)
    {
        $donacion = Donacion::findOrFail($id);
        $donacion->update(['estado' => 'Recogida confirmada']);
        return redirect()->back()->with('success', 'Recogida confirmada correctamente');
    }

    /**
     * El voluntario acepta hacerse cargo de una donación
     *
     * Asigna la donación al voluntario autenticado y cambia
     * el estado a 'Asignada' para iniciar el proceso de transporte.
     *
     * @param  int  $id ID de la donación
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje de éxito
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
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
     * La ONG confirma la recepción de la donación
     *
     * Verifica que la ONG autenticada es el destino de la donación
     * y actualiza el estado final a 'Entregada a ONG'.
     *
     * @param  int  $id ID de la donación
     * @return \Illuminate\Http\RedirectResponse Redirección con mensaje
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no existe
     * @throws \Illuminate\Auth\Access\AuthorizationException Si no tiene permiso
     */
    public function confirmarRecepcion($id)
{
    $donacion = Donacion::findOrFail($id);

    if ($donacion->id_ong_destino !== auth()->id()) {
        return redirect()->back()->with('error', 'No tienes permiso.');
    }

    $donacion->update(['estado' => 'Entregada a ONG']);

    return redirect()->back()->with('success', 'Recepción confirmada');
}


    /**
     * Lista todas las donaciones disponibles para asignación
     *
     * Muestra a los voluntarios todas las donaciones que están
     * en estado 'No asignada' y pueden ser aceptadas.
     *
     * @return \Illuminate\View\View Vista con donaciones disponibles
     */
    public function disponibles()
    {
        $donaciones = Donacion::where('estado', 'No asignada')->get();
        return view('donaciones_disponibles', ['donaciones' => $donaciones]);
    }

    /**
     * Lista las donaciones en proceso de transporte
     *
     * Para ONGs: muestra donaciones asignadas a ellos que están en camino.
     * Para voluntarios: muestra sus donaciones asignadas o recogidas.
     * Incluye información del comercio y voluntario.
     *
     * @return \Illuminate\View\View Vista con donaciones en camino
     */
    public function enCamino()
{
    if(auth()->user()->rol === 'ong') {
        // Donaciones asignadas a esta ONG y que están en camino
        $donaciones = Donacion::where('id_ong_destino', auth()->id())
            ->whereIn('estado', ['Recogida', 'Asignada', 'En camino'])
            ->with(['comercio', 'voluntario'])
            ->get();
    } else {
        // Para voluntarios, sigue mostrando solo sus donaciones asignadas
        $donaciones = Donacion::where('id_voluntario_asignado', auth()->id())
            ->whereIn('estado', ['Asignada', 'Recogida'])
            ->with(['comercio', 'voluntario'])
            ->get();
    }

    return view('donaciones.en_camino', compact('donaciones'));
}



    /**
     * Muestra el historial completo de donaciones recibidas por la ONG
     *
     * Lista todas las donaciones que han sido entregadas a la ONG
     * autenticada, tanto recogidas como entregadas completamente.
     *
     * @return \Illuminate\View\View Vista con historial de la ONG
     */
    public function historialOng()
{
    $donaciones = Donacion::where('id_ong_destino', auth()->id())
        ->whereIn('estado', ['Recogida', 'Entregada a ONG'])
        ->get();

    return view('historial_ong', ['donaciones' => $donaciones]);
}


    /**
     * Muestra el historial de donaciones del voluntario
     *
     * Lista todas las donaciones que el voluntario autenticado ha
     * transportado, incluyendo información del comercio origen.
     * También obtiene la lista de ONGs disponibles.
     *
     * @return \Illuminate\View\View Vista con historial del voluntario
     */
    public function historialVoluntario()
{
    $donaciones = Donacion::where('id_voluntario_asignado', Auth::id())
                           ->with('comercio') // para acceder al comercio desde la vista
                           ->get();

    // Aquí corregimos User por Usuario
    $ongs = Usuario::where('rol', 'ong')->get(); // Trae todas las ONGs

    return view('historial_voluntario', compact('donaciones', 'ongs'));
}


}
