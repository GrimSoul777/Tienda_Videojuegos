@extends('app')

@section('title', 'Ventas')

@section('content')
    <h1 class="text-center my-4">Ventas</h1>

    <div class="text-center mb-3">
        <x-create-venta />
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Método de pago</th>
                    <th>Total</th>
                    <th style="min-width: 250px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($ventas as $i)
                    <tr>
                        <td>{{ $i->id_venta }}</td>

                        <td>
                            {{ $i->fecha?->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            @if ($i->cliente)
                                {{ $i->cliente->nombre }}
                                {{ $i->cliente->apellidos }}
                            @else
                                <span class="text-muted">Público general</span>
                            @endif
                        </td>

                        <td>{{ $i->usuario->nombre ?? '—' }}</td>

                        <td>{{ $i->metodoPago->nombre ?? '—' }}</td>

                        <td class="text-nowrap">
                            ${{ number_format($i->total, 2) }}
                        </td>

                        <td>
                            <div class="d-flex flex-wrap align-items-center" style="gap: 5px;">
                                <button type="button"
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#detalleVenta{{ $i->id_venta }}">
                                    Ver detalle
                                </button>

                                <x-update-venta :i="$i" />
                                <x-delete-venta :i="$i" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Aún no hay ventas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Los modales van fuera de la tabla --}}
    @foreach ($ventas as $i)
        <div class="modal fade"
            id="detalleVenta{{ $i->id_venta }}"
            tabindex="-1"
            role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-left">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle de la venta #{{ $i->id_venta }}
                        </h5>

                        <button type="button" class="close"
                            data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Videojuego</th>
                                        <th>Cantidad</th>
                                        <th>Precio unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($i->detalles as $d)
                                        <tr>
                                            <td>
                                                {{ $d->videojuego->titulo ?? '—' }}
                                            </td>

                                            <td>{{ $d->cantidad }}</td>

                                            <td>
                                                ${{ number_format($d->precio_unitario, 2) }}
                                            </td>

                                            <td>
                                                ${{ number_format($d->cantidad * $d->precio_unitario, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">
                                            Total
                                        </th>

                                        <th>
                                            ${{ number_format($i->total, 2) }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
