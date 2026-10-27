@php $filas = old('detalles', [['id_videojuego' => '', 'cantidad' => 1]]);@endphp
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVenta">
    Nueva venta
</button>

<div class="modal fade" id="createVenta" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Registrar venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('venta.create') }}" method="post">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-body">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label class="small mb-1">Cliente</label>
              <select name="id_cliente" class="form-control form-control-sm">
                <option value="">Público general</option>
                @foreach ($clientes as $c)
                  <option value="{{ $c->id_cliente }}" {{ old('id_cliente') == $c->id_cliente ? 'selected' : '' }}>
                    {{ $c->nombre }} {{ $c->apellidos }}
                  </option>
                @endforeach
              </select>
              @error('id_cliente') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group col-md-4">
              <label class="small mb-1">Vendedor</label>
              <select name="id_usuario" class="form-control form-control-sm" required>
                <option value="">Selecciona...</option>
                @foreach ($usuarios as $u)
                  <option value="{{ $u->id_usuario }}" {{ old('id_usuario') == $u->id_usuario ? 'selected' : '' }}>
                    {{ $u->nombre }}
                  </option>
                @endforeach
              </select>
              @error('id_usuario') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group col-md-4">
              <label class="small mb-1">Método de pago</label>
              <select name="id_metodo_pago" class="form-control form-control-sm" required>
                <option value="">Selecciona...</option>
                @foreach ($metodosPago as $m)
                  <option value="{{ $m->id_metodo_pago }}" {{ old('id_metodo_pago') == $m->id_metodo_pago ? 'selected' : '' }}>
                    {{ $m->nombre }}
                  </option>
                @endforeach
              </select>
              @error('id_metodo_pago') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <hr>
          <label class="small mb-1">Videojuegos de la venta</label>

          <div id="filasDetalle">
            @foreach ($filas as $n => $f)
              <div class="form-row mb-2 fila-detalle">
                <div class="col-7">
                  <select name="detalles[{{ $n }}][id_videojuego]" class="form-control form-control-sm" required>
                    <option value="">Videojuego...</option>
                    @foreach ($videojuegos as $v)
                      <option value="{{ $v->id_videojuego }}"
                        {{ ($f['id_videojuego'] ?? '') == $v->id_videojuego ? 'selected' : '' }}>
                        {{ $v->titulo }} — ${{ number_format($v->precio, 2) }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-3">
                  <input type="number" name="detalles[{{ $n }}][cantidad]" class="form-control form-control-sm"
                         min="1" value="{{ $f['cantidad'] ?? 1 }}" required>
                </div>
                <div class="col-2">
                  <button type="button" class="btn btn-outline-danger btn-sm btn-quitar">Quitar</button>
                </div>
              </div>
            @endforeach
          </div>

          <button type="button" class="btn btn-outline-primary btn-sm" id="btnAgregarFila">+ Agregar juego</button>

          @error('detalles') <div><small class="text-danger">{{ $message }}</small></div> @enderror
          @foreach ($errors->get('detalles.*') as $mensajes)
            @foreach ($mensajes as $mensaje)
              <div><small class="text-danger">{{ $mensaje }}</small></div>
            @endforeach
          @endforeach
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Guardar venta</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var contenedor = document.getElementById('filasDetalle');
    var contador = contenedor.querySelectorAll('.fila-detalle').length;

    document.getElementById('btnAgregarFila').addEventListener('click', function () {
        var nueva = contenedor.querySelector('.fila-detalle').cloneNode(true);
        nueva.querySelectorAll('select, input').forEach(function (el) {
            el.name = el.name.replace(/detalles\[\d+\]/, 'detalles[' + contador + ']');
            if (el.tagName === 'SELECT') { el.selectedIndex = 0; } else { el.value = 1; }
        });
        contenedor.appendChild(nueva);
        contador++;
    });

    contenedor.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-quitar')) {
            if (contenedor.querySelectorAll('.fila-detalle').length > 1) {
                e.target.closest('.fila-detalle').remove();
            }
        }
    });
});
</script>

@if (old('form') === 'create' && $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#createVenta').modal('show');
        });
    </script>
@endif