@extends('app')
@section('title', 'Detalle de ventas')
@section('content')
    <h1 class="text-center my-4">Detalle de ventas</h1>
    <div class="table-responsive">
        <table class="table table-bordered align-middle bg-white">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Venta</th>
                    <th>Fecha</th>
                    <th>Videojuego</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detallesVenta as $i)
                    <tr>
                        <td>{{ $i->id_detalle }}</td>
                        <td>
                            <a href="{{ route('getventas') }}">#{{ $i->id_venta }}</a>
                        </td>
                        <td>{{ $i->venta?->fecha?->format('d/m/Y H:i') ?? '—' }}</td>
                        <td>{{ $i->videojuego->titulo ?? '—' }}</td>
                        <td>{{ $i->cantidad }}</td>
                        <td>${{ number_format($i->precio_unitario, 2) }}</td>
                        <td>${{ number_format($i->cantidad * $i->precio_unitario, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Aún no hay detalles de venta.</td>
                    </tr>
                @endforelse
            </tbody>
            @if ($detallesVenta->count())
                <tfoot>
                    <tr>
                        <th colspan="6" class="text-right">Total vendido</th>
                        <th>
                            ${{ number_format($detallesVenta->sum(fn ($d) => $d->cantidad * $d->precio_unitario), 2) }}
                        </th>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
@endsection