@php $mio = old('form') === 'update' . $i->id_venta; @endphp
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateVenta{{ $i->id_venta }}">
    Actualizar
</button>

<div class="modal fade" id="updateVenta{{ $i->id_venta }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar venta #{{ $i->id_venta }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('venta.update', $i->id_venta) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="update{{ $i->id_venta }}">
        <div class="modal-body">
          <div class="form-group">
            <label class="small mb-1">Cliente</label>
            <select name="id_cliente" class="form-control form-control-sm">
              <option value="">Público general</option>
              @foreach ($clientes as $c)
                @php $sel = $mio ? old('id_cliente') : $i->id_cliente; @endphp
                <option value="{{ $c->id_cliente }}" {{ $sel == $c->id_cliente ? 'selected' : '' }}>
                  {{ $c->nombre }} {{ $c->apellidos }}
                </option>
              @endforeach
            </select>
            @if ($mio) @error('id_cliente') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>

          <div class="form-group">
            <label class="small mb-1">Vendedor</label>
            <select name="id_usuario" class="form-control form-control-sm" required>
              @foreach ($usuarios as $u)
                @php $sel = $mio ? old('id_usuario') : $i->id_usuario; @endphp
                <option value="{{ $u->id_usuario }}" {{ $sel == $u->id_usuario ? 'selected' : '' }}>
                  {{ $u->nombre }}
                </option>
              @endforeach
            </select>
            @if ($mio) @error('id_usuario') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>

          <div class="form-group">
            <label class="small mb-1">Método de pago</label>
            <select name="id_metodo_pago" class="form-control form-control-sm" required>
              @foreach ($metodosPago as $m)
                @php $sel = $mio ? old('id_metodo_pago') : $i->id_metodo_pago; @endphp
                <option value="{{ $m->id_metodo_pago }}" {{ $sel == $m->id_metodo_pago ? 'selected' : '' }}>
                  {{ $m->nombre }}
                </option>
              @endforeach
            </select>
            @if ($mio) @error('id_metodo_pago') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>

          <small class="text-muted">Los videojuegos y el total de una venta no se pueden modificar.</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@if ($mio && $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#updateVenta{{ $i->id_venta }}').modal('show');
        });
    </script>
@endif