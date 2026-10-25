@extends('app')

@section('title', 'Inicio')

@section('content')
    <div class="text-center py-5">
        <a href="#" type="button" class="btn btn-success btn btn-primary btn-lg">Ver catálogo</a>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Soy cliente</h5>
                    <p class="text-muted">Inicia sesión o crea tu cuenta para comprar.</p>
                    <a href="#" class="btn btn-outline-primary">Iniciar sesión</a>
                    <a href="#" class="btn btn-primary">Registrarme</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Soy trabajador</h5>
                    <p class="text-muted">Acceso al panel de administración.</p>
                    <a href="#" class="btn btn-outline-primary">Iniciar sesión</a>
                    <a href="#" class="btn btn-primary">Registrarme</a>
                </div>
            </div>
        </div>
    </div>
@endsection