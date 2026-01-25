@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            {{-- BOTÓN LOGOUT --}}
            <div class="d-flex justify-content-end mb-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        Cerrar sesión
                    </button>
                </form>
            </div>

            <div class="list-container">
                <h1>Donaciones Disponibles</h1>
                <p class="subtitle">Selecciona la donación que quieres recoger</p>

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
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donaciones ?? [] as $donacion)
                            <tr>
                                <td>{{ $donacion->tipo_comida ?? 'N/A' }}</td>
                                <td>{{ $donacion->cantidad ?? 'N/A' }}</td>
                                <td>{{ $donacion->fecha_hora ?? 'N/A' }}</td>
                                <td>{{ $donacion->punto_recogida ?? 'N/A' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('donaciones.aceptar', $donacion->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="accept-btn btn btn-success">
                                            Aceptar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No hay donaciones disponibles
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <a href="{{ route('home') }}" class="register-link">
                    Volver al inicio
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/donaciones_disponibles.css') }}">
@endsection
