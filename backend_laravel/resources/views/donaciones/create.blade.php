@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            {{-- Encabezado --}}
            <header class="topbar mb-5">
                <h1>Panel de Comercio</h1>
            </header>

            <main class="container-main">

                {{-- Formulario de Publicar Excedente --}}
                <section class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Publicar Excedente</h2>

                       <form method="POST" action="{{ route('donaciones.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="tipo_comida">Tipo de comida</label>
        <select id="tipo_comida" name="tipo_comida" class="form-control" required>
            <option value="">Selecciona…</option>
            <option value="panaderia">Panadería</option>
            <option value="verduras">Verduras</option>
            <option value="comida_preparada">Comida preparada</option>
            <option value="lacteos">Lácteos</option>
        </select>
    </div>

    <div class="form-group">
        <label for="cantidad">Cantidad (uds / kg)</label>
        <input type="number"
               id="cantidad"
               name="cantidad"
               class="form-control"
               min="0.1"
               step="0.1"
               required>
    </div>

    <div class="form-group">
        <label for="fecha_hora">Fecha y hora disponibles</label>
        <input type="datetime-local"
               id="fecha_hora"
               name="fecha_hora"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label for="punto_recogida">Punto de recogida</label>
        <input type="text"
               id="punto_recogida"
               name="punto_recogida"
               class="form-control"
               required>
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" name="estado" class="form-control" required>
            <option value="No asignada">No asignada</option>
            <option value="Asignada">Asignada</option>
            <option value="En camino">En camino</option>
        </select>
    </div>

    <div class="form-group">
        <label for="observaciones">Observaciones</label>
        <textarea id="observaciones"
                  name="observaciones"
                  class="form-control"
                  rows="4"></textarea>
    </div>

    <div class="form-group">
        <label for="foto">Foto (opcional)</label>
        <input type="file"
               id="foto"
               name="foto"
               class="form-control"
               accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Publicar donación</button>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
</form>
                    </div>
                </section>

                {{-- Lista de Donaciones --}}
                <section class="card">
                    <div class="card-body">
                        <h2 class="card-title">Mis Donaciones</h2>
                        <div id="listaDonaciones">
                            {{-- Las donaciones se cargarán aquí dinámicamente --}}
                        </div>
                    </div>
                </section>

            </main>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/comercio.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/comercio.js') }}" defer></script>
@endsection