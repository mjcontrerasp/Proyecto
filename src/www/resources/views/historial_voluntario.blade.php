@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="list-container">
                <h1>Historial de Donaciones</h1>
                <p class="subtitle">Todas las donaciones que te han sido asignadas</p>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="donaciones-table table table-striped">
                    <thead>
                        <tr>
                            <th>Tipo de comida</th>
                            <th>Cantidad</th>
                            <th>Comercio</th>
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

                                <td>
                                    @if($donacion->estado == 'Asignada')
                                        <span class="badge bg-warning text-dark">Asignada</span>
                                    @elseif($donacion->estado == 'Recogida')
                                        <span class="badge bg-info text-dark">Recogida</span>
                                    @elseif($donacion->estado == 'Entregada')
                                        <span class="badge bg-success">Entregada</span>
                                    @else
                                        {{ $donacion->estado ?? 'N/A' }}
                                    @endif
                                </td>

                                <td>
                                    @if($donacion->estado == 'Asignada')
                                        {{-- Formulario para marcar como recogida y elegir ONG --}}
                                        <form method="POST" action="{{ route('donaciones.recoger', $donacion->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <select name="id_ong_destino" class="form-select mb-2" required>
                                                <option value="">Selecciona ONG destino</option>
                                                @foreach($ongs as $ong)
                                                    <option value="{{ $ong->id_usuario }}">
                                                        {{ $ong->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="submit" class="btn btn-sm btn-success">
                                                Recogido del comercio
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No tienes donaciones asignadas</td>
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
<link rel="stylesheet" href="{{ asset('css/historial_voluntario.css') }}">
@endsection
