@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="login-container">
                <h1>Perfil de Usuario</h1>
                <p class="subtitle">Actualiza tus datos personales</p>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="login-form" method="POST" action="{{ route('perfil.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" 
                               id="nombre" 
                               name="nombre" 
                               placeholder="Tu nombre completo" 
                               value="{{ old('nombre', auth()->user()->nombre ?? '') }}"
                               required>
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               placeholder="tucorreo@ejemplo.com" 
                               value="{{ old('email', auth()->user()->email ?? '') }}"
                               required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group password-wrapper">
                        <label for="password">Contraseña</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Nueva contraseña (dejar en blanco para no cambiar)">
                        <button type="button" id="togglePassword">👀</button>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit">Guardar cambios</button>
                </form>

                <div class="divider"></div>
                <a href="{{ route('home') }}" class="register-link">Volver al inicio</a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/perfil_usuario.css') }}">
@endsection
