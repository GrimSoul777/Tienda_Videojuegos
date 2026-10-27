@extends('app')

@section('title', 'Videojuegos')

@section('content')
    <h1 class="text-center my-4">Videojuegos</h1>

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="text-center mb-4">
        <x-create-videojuegos/>
    </div>

    <div class="row">
        @forelse ($videojuegos->sortBy('titulo') as $i)
            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="d-flex align-items-center justify-content-center text-white"
                        style="height: 140px; font-size: 3rem; font-weight: bold;
                            background: hsl({{ ($i->id_videojuego * 47) % 360 }}, 50%, 40%);">
                        {{ mb_strtoupper(mb_substr($i->titulo, 0, 1)) }}
                    </div>

                    <div class="card-body text-left">
                        <h5 class="card-title mb-1">{{ $i->titulo }}</h5>
                        <p class="text-muted small mb-2">
                            {{ $i->desarrolladora->nombre ?? '—' }}
                            @if ($i->fecha_lanzamiento)
                                · {{ $i->fecha_lanzamiento->format('Y') }}
                            @endif
                        </p>

                        <span class="badge badge-info">{{ $i->categoria->nombre ?? 'Sin categoría' }}</span>
                        @foreach ($i->plataformas as $p)
                            <span class="badge badge-secondary">{{ $p->nombre }}</span>
                        @endforeach

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <strong class="h5 mb-0">${{ number_format($i->precio, 2) }}</strong>
                            @if (!$i->inventario)
                                <span class="badge badge-dark">Sin inventario</span>
                            @elseif ($i->inventario->stock == 0)
                                <span class="badge badge-danger">Agotado</span>
                            @else
                                <span class="badge badge-success">Disponible: {{ $i->inventario->stock }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#verVideojuego{{ $i->id_videojuego }}">
                            Ver
                        </button>
                        <x-update-videojuegos :i="$i"/>
                        <x-delete-videojuegos :i="$i"/>
                    </div>
                </div>

                <div class="modal fade" id="verVideojuego{{ $i->id_videojuego }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content text-left">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $i->titulo }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $i->descripcion ?: 'Sin descripción.' }}</p>
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Categoría:</strong> {{ $i->categoria->nombre ?? '—' }}</li>
                                    <li><strong>Desarrolladora:</strong> {{ $i->desarrolladora->nombre ?? '—' }}</li>
                                    <li><strong>Lanzamiento:</strong> {{ $i->fecha_lanzamiento?->format('d/m/Y') ?? '—' }}</li>
                                    <li><strong>Plataformas:</strong> {{ $i->plataformas->pluck('nombre')->join(', ') ?: '—' }}</li>
                                    <li><strong>Precio:</strong> ${{ number_format($i->precio, 2) }}</li>
                                    <li><strong>Stock:</strong> {{ $i->inventario->stock ?? 'Sin inventario' }}</li>
                                    <li><strong>Ubicación:</strong> {{ $i->inventario->ubicacion ?? '—' }}</li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">Aún no hay videojuegos.</div>
        @endforelse
    </div>
@endsection