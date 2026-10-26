@extends('app')
@section('title', 'Categorías')
@section('content')
    <h1 class="text-center my-4">Categorías</h1>
    <div class="text-center mb-3">
        <x-create-categoria/>
    </div>

    <table class="table table-bordered bg-white">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th style="width: 200px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categoria as $i)
                <tr>
                    <td>{{ $i->id_categoria }}</td>
                    <td>{{ $i->nombre }}</td>
                    <td>{{ $i->descripcion }}</td>
                    <td>
                        <x-update-categoria :i="$i"/>
                        <x-delete-categoria :i="$i"/>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Aún no hay categorías.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection