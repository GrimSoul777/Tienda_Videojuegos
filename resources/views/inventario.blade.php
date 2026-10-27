@extends('app')

@section('title', 'Inventario')

@section('content')
    <h1 class="text-center my-4">Inventario</h1>

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <x-create-inventario/>
        <input type="search" id="buscarInv" class="form-control form-control-sm"
               style="width: 220px" placeholder="Buscar videojuego...">
    </div>

    <table class="table table-bordered align-middle bg-white">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Videojuego</th>
                <th>Stock</th>
                <th>Ubicación</th>
                <th style="width: 200px">Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaInv">
            @forelse ($inventario->sortBy('id_inventario') as $i)
                <tr data-titulo="{{ mb_strtolower($i->videojuego->titulo ?? '') }}">
                    <td>{{ $i->id_inventario }}</td>
                    <td>{{ $i->videojuego->titulo ?? '—' }}</td>
                    <td>
                        @if ($i->stock == 0)
                            <span class="badge badge-danger">Agotado</span>
                        @elseif ($i->stock <= 5)
                            <span class="badge badge-warning">{{ $i->stock }} (bajo)</span>
                        @else
                            <span class="badge badge-success">{{ $i->stock }}</span>
                        @endif
                    </td>
                    <td>{{ $i->ubicacion ?: '—' }}</td>
                    <td>
                        <x-update-inventario :i="$i"/>
                        @if ($i->stock == 0)
                            <x-delete-inventario :i="$i"/>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aún no hay registros de inventario.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var filas = document.querySelectorAll('#tablaInv tr[data-titulo]');
        document.getElementById('buscarInv').addEventListener('input', function () {
            var texto = this.value.trim().toLowerCase();
            filas.forEach(function (f) {
                f.style.display = f.dataset.titulo.indexOf(texto) !== -1 ? '' : 'none';
            });
        });
    });
    </script>
@endsection