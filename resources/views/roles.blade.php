
@extends('app')

@section('title', 'Roles')

@section('content')
    <h1 class="text-center my-4">Roles</h1>

    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <x-create-rol />
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-10 offset-lg-1">

            @if (session('mensaje'))
                <div class="alert alert-success">
                    {{ session('mensaje') }}
                </div>
            @endif

            <table class="table table-bordered align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($roles as $i)
                        <tr>
                            <td>{{ $i->id_rol }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->descripcion ?? 'Sin descripción' }}</td>
                            <td>
                                <x-update-rol :i="$i" />
                                <x-delete-rol :i="$i" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Aún no hay roles registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
