@extends('app')
@section('title', 'Plataformas')
@section('content')
    <h1 class="text-center my-4">Plataformas</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <x-create-plataformas/>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered align-middle bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fabricante</th>
                        <th style="width: 200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($plataformas as $i)
                        <tr>
                            <td>{{ $i->id_plataforma }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->fabricante }}</td>
                            <td>
                                <x-update-plataformas :i="$i"/>
                                <x-delete-plataformas :i="$i"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aún no hay plataformas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection