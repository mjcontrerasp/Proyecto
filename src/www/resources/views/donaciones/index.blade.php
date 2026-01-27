@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="list-container">
                <h1>Mis Donaciones</h1>
                <p class="subtitle">Gestiona tus publicaciones de comida</p>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="donaciones-table table table-striped">
                    <thead>
                        <tr>
    <th>Tipo de comida</th>
    <th>Cantidad</th>
    <th>Fecha límite</th>
    <th>Punto de recogida</th>
    <th>Estado</th>
    <th>Voluntario</th>
    <th>Acciones</th>
</tr>

                    </thead>
                    <tbody>
                        @forelse($donaciones ?? [] as $donacion)
                            <tr>
                                <td>{{ $donacion->tipo_comida ?? 'N/A' }}</td>
                                <td>{{ $donacion->cantidad ?? 'N/A' }}</td>
                                <td>{{ $donacion->fecha_hora ?? 'N/A' }}</td>
                                <td>{{ $donacion->punto_recogida ?? 'N/A' }}</td>
                                <td>{{ $donacion->estado ?? 'No asignada' }}</td>

<td>
    @if($donacion->voluntario)
        {{ $donacion->voluntario->nombre }}
    @else
        <span class="text-muted">Sin asignar</span>
    @endif
</td>

<td>
    <a href="{{ route('donaciones.edit', $donacion->id) }}" class="edit-btn btn btn-sm btn-warning">Editar</a>
    <form method="POST" action="{{ route('donaciones.destroy', $donacion->id) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-btn btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta donación?')">Eliminar</button>
    </form>
</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tienes donaciones publicadas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <a href="{{ route('donaciones.create') }}" class="register-link btn btn-primary">Crear nueva donación</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mis_donaciones.css') }}">
@endsection
