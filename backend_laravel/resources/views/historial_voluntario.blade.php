@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            

            <div class="list-container">
                <h1>Historial de Donaciones</h1>
                <p class="subtitle">Todas las donaciones que has entregado</p>

                <table class="donaciones-table table table-striped">
                    <thead>
                        <tr>
                            <th>Tipo de comida</th>
                            <th>Cantidad</th>
                            <th>Comercio</th>
                            <th>Fecha de entrega</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donaciones ?? [] as $donacion)
                            <tr>
                                <td>{{ $donacion->tipo_comida ?? 'N/A' }}</td>
                                <td>{{ $donacion->cantidad ?? 'N/A' }}</td>
                                <td>{{ $donacion->comercio->nombre_comercial ?? 'N/A' }}</td>
                                <td>{{ optional($donacion->updated_at)->format('d/m/Y H:i') ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    No tienes historial de donaciones
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
    <link rel="stylesheet" href="{{ asset('css/historial_voluntario.css') }}">
@endsection
