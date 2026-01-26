@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="login-container">
                <h1>Detalle de Donación</h1>
                <p class="subtitle">Información de tu donación y estado de recogida</p>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="donacion-info">
                    <p><strong>Tipo de comida:</strong> {{ $donacion->tipo ?? 'No especificado' }}</p>
                    <p><strong>Cantidad:</strong> {{ $donacion->cantidad ?? 'N/A' }}</p>
                    <p><strong>Fecha límite:</strong> {{ $donacion->fecha ?? 'No especificada' }}</p>
                    <p><strong>Punto de recogida:</strong> {{ $donacion->punto_recogida ?? 'No especificado' }}</p>
                    <p><strong>Voluntario asignado:</strong> {{ $donacion->voluntario ?? 'Pendiente de asignar' }}</p>
                    <p><strong>Estado de recogida:</strong> {{ $donacion->estado ?? 'Pendiente' }}</p>
                </div>

                <form method="POST" action="{{ route('donaciones.confirmar', $donacion->id ?? '#') }}" class="d-inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="confirm-btn">Confirmar Recogida</button>
                </form>

                <div class="divider"></div>
                <a href="{{ route('donaciones.index') }}" class="register-link">Volver a mis donaciones</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detalle_donacion_comercio.css') }}">
@endsection
