@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="container">
                <h1>Recuperar Contraseña</h1>
                <p class="subtitle">Ingresa tu correo para recibir el enlace de recuperación</p>

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

                <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" 
               id="email" 
               name="email" 
               placeholder="tucorreo@ejemplo.com" 
               value="{{ old('email') }}"
               required>

        @error('email')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-primario">
        Enviar enlace de recuperación
    </button>
</form>

                <p class="small mt-3">
                    <a href="{{ route('login') }}">Volver al inicio</a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/recuperar_contrasena.css') }}">
@endsection
