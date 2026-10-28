<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createInventario">
    Nuevo registro
</button>

<div class="modal fade" id="createInventario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Registrar inventario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('inventario.create') }}" method="post">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-body">
          <div class="form-group">
            <label class="small mb-1">Videojuego</label>
            <select name="id_videojuego" class="form-control form-control-sm" required>
              <option value="">Selecciona...</option>
              @foreach ($videojuegos as $v)
                <option value="{{ $v->id_videojuego }}" {{ old('id_videojuego') == $v->id_videojuego ? 'selected' : '' }}>
                  {{ $v->titulo }}
                </option>
              @endforeach
            </select>
            @if ($videojuegos->isEmpty())
              <small class="text-muted">Todos los videojuegos ya tienen inventario, o aún no hay videojuegos.</small>
            @endif
            @error('id_videojuego') <small class="text-danger d-block">{{ $message }}</small> @enderror
          </div>
          <div class="form-group">
            <label class="small mb-1">Stock</label>
            <input class="form-control form-control-sm" type="number" name="stock" min="0" step="1" value="{{ old('stock', 0) }}" required>
            @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="form-group">
            <label class="small mb-1">Ubicación</label>
            <input class="form-control form-control-sm" type="text" name="ubicacion" maxlength="255" value="{{ old('ubicacion') }}" placeholder="Ej. Estante A2 (opcional)">
            @error('ubicacion') <small class="text-danger">{{ $message }}</small> @enderror
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

@if (old('form') === 'create' && $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#createInventario').modal('show');
        });
    </script>
@endif