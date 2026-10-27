@extends('app')

@section('title', 'Usuarios')

@section('content')
    <h1 class="text-center my-4">Usuarios</h1>

    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <x-create-usuario/>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-10 offset-lg-1">
            <table class="table table-bordered align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($usuarios as $i)
                        <tr>
                            <td>{{ $i->id_usuario }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->email }}</td>
                            <td>{{ $i->rol->nombre ?? 'Sin rol' }}</td>
                            <td>
                                <x-update-usuario :i="$i"/>
                                <x-delete-usuario :i="$i"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Aún no hay usuarios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection