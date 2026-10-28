@extends('app')
@section('title', 'Métodos de pago')
@section('content')
    <h1 class="text-center my-4">Metodos de pago</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <x-create-metodos-pago/>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8 offset-lg-2">
            <table class="table table-bordered align-middle bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th style="width: 200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($metodosPago as $i)
                        <tr>
                            <td>{{ $i->id_metodo_pago }}</td>
                            <td>{{ $i->nombre }}</td>
                            <td>{{ $i->descripcion }}</td>
                            <td>
                                <x-update-metodos-pago :i="$i"/>
                                <x-delete-metodos-pago :i="$i"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aún no hay métodos de pago.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection