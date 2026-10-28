@php $mio = old('form') === 'update' . $i->id_metodo_pago; @endphp
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateMetodoPago{{ $i->id_metodo_pago }}">
    Actualizar
</button>

<div class="modal fade" id="updateMetodoPago{{ $i->id_metodo_pago }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar método de pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('metodopago.update', $i->id_metodo_pago) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="update{{ $i->id_metodo_pago }}">
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" maxlength="50"
                   value="{{ $mio ? old('nombre') : $i->nombre }}" placeholder="Nombre" required>
            @if ($mio) @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>
          <div class="mb-2">
            <textarea class="form-control form-control-sm" name="descripcion" rows="2" maxlength="150"
                      placeholder="Descripción (opcional)">{{ $mio ? old('descripcion') : $i->descripcion }}</textarea>
            @if ($mio) @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>
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
            $('#updateMetodoPago{{ $i->id_metodo_pago }}').modal('show');
        });
    </script>
@endif