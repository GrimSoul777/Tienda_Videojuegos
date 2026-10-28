@extends('app')
@section('title', 'Desarrolladoras')
@section('content')
    <h1 class="text-center my-4">Desarrolladoras</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <x-create-desarrolladoras/>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered align-middle bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>País</th>
                        <th style="width: 200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($desarrolladoras as $i)
                        <tr>
                            <td>{{ $i->id_desarrolladora }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->pais }}</td>
                            <td>
                                <x-update-desarrolladoras :i="$i"/>
                                <x-delete-desarrolladoras :i="$i"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aún no hay desarrolladoras.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection