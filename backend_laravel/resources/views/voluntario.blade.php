@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <header class="topbar mb-5">
                <h1>Donaciones Disponibles</h1>
            </header>

            <main class="container-main">

                {{-- Filtros --}}
                <section class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Filtros</h2>

                        <form method="GET" action="{{ route('voluntario.donaciones') }}">
                            <div class="form-group">
                                <label>Tipo de alimento</label>
                                <select name="tipo" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="panaderia" {{ request('tipo') == 'panaderia' ? 'selected' : '' }}>Panadería</option>
                                    <option value="verduras" {{ request('tipo') == 'verduras' ? 'selected' : '' }}>Verduras</option>
                                    <option value="comida_preparada" {{ request('tipo') == 'comida_preparada' ? 'selected' : '' }}>Comida preparada</option>
                                    <option value="lacteos" {{ request('tipo') == 'lacteos' ? 'selected' : '' }}>Lácteos</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" 
                                       name="fecha" 
                                       class="form-control"
                                       value="{{ request('fecha') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </form>
                    </div>
                </section>

                {{-- Resultados --}}
                <section class="card">
                    <div class="card-body">
                        <h2 class="card-title">Resultados</h2>
                        
                        <div id="donaciones">
                            @forelse($donaciones ?? [] as $donacion)
                                <div class="donacion-item mb-3 p-3 border">
                                    <p><strong>Tipo:</strong> {{ $donacion->tipo ?? 'N/A' }}</p>
                                    <p><strong>Cantidad:</strong> {{ $donacion->cantidad ?? 'N/A' }}</p>
                                    <p><strong>Fecha:</strong> {{ $donacion->fecha ?? 'N/A' }}</p>
                                    <p><strong>Punto de recogida:</strong> {{ $donacion->punto_recogida ?? 'N/A' }}</p>
                                    
                                    <form method="POST" action="{{ route('donaciones.aceptar', $donacion->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Aceptar donación</button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-muted">No hay donaciones disponibles con los filtros seleccionados</p>
                            @endforelse
                        </div>
                    </div>
                </section>

            </main>

        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/voluntario.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/voluntario.js') }}" defer></script>
@endsection