@extends('layouts.app')

@section('content')

<main class="login-container">

    <h1>SocialFood</h1>
    <p class="subtitle">Inicia sesión con tu cuenta</p>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email"
                   id="email"
                   name="email"
                   placeholder="correo@ejemplo.com"
                   value="{{ old('email') }}"
                   required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <div class="password-wrapper">
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="********"
                       required>
                <button type="button" id="togglePassword" aria-label="Mostrar contraseña">👁</button>
            </div>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group checkbox">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Recordarme</label>
        </div>

        <button type="submit">Iniciar sesión</button>
    </form>

    <p class="register-link">
        ¿No tienes cuenta? <a href="{{ route('register') }}">Registrarse</a>
    </p>

    <p class="register-link">
        ¿No recuerdas cuál es tu cuenta?
        <a href="{{ route('password.request') }}">Recuperar</a>
    </p>

</main>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


