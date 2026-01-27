@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <main class="login-container">
                <h1>Completa los datos del comercio</h1>
                <p class="subtitle">Rellena la información de tu negocio</p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('comercio.store') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="nombre_comercial">Nombre comercial</label>
                        <input type="text"
                               id="nombre_comercial"
                               name="nombre_comercial"
                               placeholder="Ej: Panadería San Juan"
                               value="{{ old('nombre_comercial') }}"
                               required>
                        @error('nombre_comercial')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text"
                               id="direccion"
                               name="direccion"
                               placeholder="Calle Mayor, 12"
                               value="{{ old('direccion') }}">
                        @error('direccion')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="horario">Horario</label>
                        <input type="text"
                               id="horario"
                               name="horario"
                               placeholder="L-V 9:00-14:00"
                               value="{{ old('horario') }}">
                        @error('horario')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group checkbox">
                        <input type="checkbox"
                               id="activo"
                               name="activo"
                               value="1"
                               {{ old('activo', true) ? 'checked' : '' }}>
                        <label for="activo">Comercio activo</label>
                    </div>

                    <button type="submit">Registrar comercio</button>
                </form>

            </main>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/comercio.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/registrar-comercio.js') }}" defer></script>
@endsection
