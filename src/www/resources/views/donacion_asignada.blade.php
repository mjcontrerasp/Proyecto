@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="login-container">
                <h1>Donación Asignada</h1>
                <p class="subtitle">Detalles de la donación que debes recoger</p>

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
                    <p><strong>Comercio:</strong> {{ $donacion->comercio ?? 'No especificado' }}</p>
                    <p><strong>Estado:</strong> {{ $donacion->estado ?? 'Pendiente' }}</p>
                </div>

                <div class="buttons">
                    <form method="POST" action="{{ route('donaciones.recoger', $donacion->id ?? '#') }}" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="recoger-btn">Marcar como Recogida</button>
                    </form>

                    <form method="POST" action="{{ route('donaciones.entregar', $donacion->id ?? '#') }}" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="entregar-btn">Marcar como Entregada</button>
                    </form>
                </div>

                <div class="divider"></div>
                <a href="{{ route('donaciones.disponibles') }}" class="register-link">Volver a donaciones disponibles</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/donacion_asignada.css') }}">
@endsection
