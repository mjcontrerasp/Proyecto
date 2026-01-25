@extends('layouts.app')

@section('title', 'Home - SocialFood')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center py-5">
                <h1 class="mb-4">Bienvenido a SocialFood</h1>
                <p class="lead mb-4">{{ Auth::user()->nombre }}, bienvenido a nuestra plataforma de donación de alimentos</p>
                
                @if(Auth::user()->rol === 'comercio')
                    <div class="alert alert-info">
                        Eres un comercio. Puedes publicar tus excedentes de alimentos aquí.
                    </div>
                    <a href="{{ route('donaciones.create') }}" class="btn btn-success btn-lg me-2">Publicar Donación</a>
                    <a href="{{ route('donaciones.index') }}" class="btn btn-primary btn-lg">Mis Donaciones</a>
                @elseif(Auth::user()->rol === 'voluntario')
                    <div class="alert alert-info">
                        Eres un voluntario. Puedes aceptar donaciones para transportarlas.
                    </div>
                    <a href="{{ route('donaciones.disponibles') }}" class="btn btn-success btn-lg me-2">Ver Donaciones</a>
                    <a href="{{ route('historial.voluntario') }}" class="btn btn-primary btn-lg">Mi Historial</a>
                @else
                    <div class="alert alert-info">
                        Eres administrador de ONG. Puedes ver todas las donaciones.
                    </div>
                    <a href="{{ route('donaciones.en-camino') }}" class="btn btn-success btn-lg me-2">Donaciones en Camino</a>
                    <a href="{{ route('historial.ong') }}" class="btn btn-primary btn-lg">Historial</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
