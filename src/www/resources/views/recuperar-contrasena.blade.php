@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        <h1>Recuperar contraseña</h1>
        <p class="subtitle">
            Ingresa tu correo y te mostraremos una nueva contraseña
        </p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('password'))
            <div class="alert alert-warning">
                <strong>Tu nueva contraseña es:</strong><br>
                {{ session('password') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="tucorreo@ejemplo.com"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-primario">
                Generar nueva contraseña
            </button>
        </form>

        <p class="small">
            <a href="{{ route('login') }}">← Volver al inicio de sesión</a>
        </p>

    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/recuperar_contrasena.css') }}">
@endsection
