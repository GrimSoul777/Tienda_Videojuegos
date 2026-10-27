@php $mio = old('form') === 'update' . $i->id_inventario; @endphp

<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateInventario{{ $i->id_inventario }}">
    Ajustar
</button>

<div class="modal fade" id="updateInventario{{ $i->id_inventario }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Inventario de {{ $i->videojuego->titulo ?? 'videojuego' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('inventario.update', $i->id_inventario) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="update{{ $i->id_inventario }}">
        <input type="hidden" name="id_videojuego" value="{{ $i->id_videojuego }}">
        <div class="modal-body">
          <div class="form-group">
            <label class="small mb-1">Stock</label>
            <input class="form-control form-control-sm" type="number" name="stock" min="0" step="1"
                   value="{{ $mio ? old('stock') : $i->stock }}" required>
            @if ($mio) @error('stock') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>
          <div class="form-group mb-0">
            <label class="small mb-1">Ubicación</label>
            <input class="form-control form-control-sm" type="text" name="ubicacion" maxlength="100"
                   value="{{ $mio ? old('ubicacion') : $i->ubicacion }}" placeholder="Opcional">
            @if ($mio) @error('ubicacion') <small class="text-danger">{{ $message }}</small> @enderror @endif
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
            $('#updateInventario{{ $i->id_inventario }}').modal('show');
        });
    </script>
@endif