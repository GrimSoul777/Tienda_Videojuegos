@extends('app')
@section('title', 'Clientes')
@section('content')
    <h1 class="text-center my-4">Clientes</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <x-create-cliente/>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-10 offset-lg-1">
            <table class="table table-bordered align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $i)
                        <tr>
                            <td>{{ $i->id_cliente }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->apellidos }}</td>
                            <td>{{ $i->email }}</td>
                            <td>{{ $i->telefono }}</td>
                            <td>
                                <x-update-cliente :i="$i"/>
                                <x-delete-cliente :i="$i"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aún no hay clientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection