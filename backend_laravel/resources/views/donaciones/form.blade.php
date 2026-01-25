@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="login-container">
                <h1>Donación de Comida</h1>
                <p class="subtitle">
                    {{ isset($donacion) ? 'Edita tu donación' : 'Completa los datos para publicar tu donación' }}
                </p>

                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $route = isset($donacion) 
                        ? route('donaciones.update', $donacion->id)
                        : route('donaciones.store');
                    $method = isset($donacion) ? 'PUT' : 'POST';
                @endphp

                <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
                    @csrf
                    @if($method === 'PUT')
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label>Tipo de comida</label>
                        <input type="text"
                               name="tipo_comida"
                               class="form-control"
                               required
                               value="{{ old('tipo_comida', $donacion->tipo_comida ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="number"
                               name="cantidad"
                               class="form-control"
                               min="0.1"
                               step="0.1"
                               required
                               value="{{ old('cantidad', $donacion->cantidad ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Fecha y hora</label>
                        <input type="datetime-local"
                               name="fecha_hora"
                               class="form-control"
                               required
                               value="{{ old('fecha_hora', isset($donacion)
                                    ? \Carbon\Carbon::parse($donacion->fecha_hora)->format('Y-m-d\TH:i')
                                    : '') }}">
                    </div>

                    <div class="form-group">
                        <label>Punto recogida</label>
                        <input type="text"
                               name="punto_recogida"
                               class="form-control"
                               required
                               value="{{ old('punto_recogida', $donacion->punto_recogida ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado" class="form-control" required>
                            @foreach(['No asignada','Asignada','Recogida','Entregada'] as $estado)
                                <option value="{{ $estado }}"
                                    @selected(old('estado', $donacion->estado ?? '') === $estado)>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea name="observaciones"
                                  class="form-control"
                                  rows="4">{{ old('observaciones', $donacion->observaciones ?? '') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ isset($donacion) ? 'Actualizar donación' : 'Publicar donación' }}
                    </button>
                </form>

                <div class="divider"></div>
                <a href="{{ route('donaciones.index') }}" class="register-link">
                    Volver a mis donaciones
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/donacion_form.css') }}">
@endsection
