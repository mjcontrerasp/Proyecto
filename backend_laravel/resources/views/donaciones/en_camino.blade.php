@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="list-container">
                <h1>Donaciones en Camino</h1>
                <p class="subtitle">Confirma las donaciones que están llegando</p>

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
                            <th>Comercio</th>
                            <th>Voluntario</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donaciones ?? [] as $donacion)
                            <tr>
                                <td>{{ $donacion->tipo_comida ?? 'N/A' }}</td>
                                <td>{{ $donacion->cantidad ?? 'N/A' }}</td>
                                <td>{{ $donacion->comercio->nombre_comercial ?? 'N/A' }}</td>
<td>{{ $donacion->voluntario->nombre ?? 'N/A' }}</td>

                                <td>{{ $donacion->estado ?? 'En camino' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('donaciones.confirmar-recepcion', $donacion->id) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="confirm-btn btn btn-primary">Confirmar Recepción</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay donaciones en camino</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <a href="{{ route('home') }}" class="register-link">Volver al inicio</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/donaciones_en_camino.css') }}">
@endsection
