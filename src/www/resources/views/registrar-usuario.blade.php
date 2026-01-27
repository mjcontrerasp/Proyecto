@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <main class="container">
                <h1>Crear cuenta</h1>
                <p class="subtitle">Regístrate para acceder a SocialFood Badajoz</p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <input id="nombre" name="nombre" type="text"
                               value="{{ old('nombre') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo_usuario">Tipo de usuario</label>
                        <select id="tipo_usuario" name="tipo_usuario" required>
                            <option value="">Selecciona una opción…</option>
                            <option value="comercio" {{ old('tipo_usuario') == 'comercio' ? 'selected' : '' }}>Comercio</option>
                            <option value="voluntario" {{ old('tipo_usuario') == 'voluntario' ? 'selected' : '' }}>Voluntario</option>
                            <option value="ong" {{ old('tipo_usuario') == 'ong' ? 'selected' : '' }}>ONG</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input id="email" name="email" type="email"
                               value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" name="telefono" type="tel"
                               value="{{ old('telefono') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" name="password" type="password" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required>
                    </div>

                    <button type="submit">Crear cuenta</button>

                    <p class="small">
                        ¿Ya tienes cuenta?
                        <a href="{{ route('login') }}">Iniciar sesión</a>
                    </p>
                </form>
            </main>

        </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/registrar_usuario.css') }}">
@endsection
