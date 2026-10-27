@extends('app')

@section('title', 'Reseñas')

@section('content')
    <h1 class="text-center my-4">Reseñas</h1>

    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (auth()->check() && auth()->user()->rol?->nombre === 'Cliente')
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <x-create-resena
                    :videojuegos="$videojuegos" />
            </div>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-lg-11 offset-lg-1">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Videojuego</th>
                        <th>Calificación</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($resenas as $i)
                        <tr>
                            <td>{{ $i->id_resena }}</td>

                            <td>
                                {{ $i->usuario?->nombre ?? 'Sin usuario' }}
                            </td>

                            <td>
                                {{ $i->videojuego?->titulo ?? 'Sin videojuego' }}
                            </td>

                            <td>{{ $i->calificacion }} / 5</td>

                            <td>{{ $i->comentario ?? 'Sin comentario' }}</td>

                            <td>
                                {{ $i->fecha?->format('d/m/Y') ?? 'Sin fecha' }}
                            </td>

                            <td>
                                @if (
                                    auth()->check()
                                    && auth()->user()->rol?->nombre === 'Cliente'
                                    && auth()->id() === $i->id_usuario
                                )
                                    <x-update-resena :i="$i" />
                                    <x-delete-resena :i="$i" />
                                @else
                                    <span class="text-muted">Sin acciones</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Aún no hay reseñas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection