@php $mio = old('form') === 'update' . $i->id_desarrolladora; @endphp
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateDesarrolladora{{ $i->id_desarrolladora }}">
    Actualizar
</button>

<div class="modal fade" id="updateDesarrolladora{{ $i->id_desarrolladora }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar desarrolladora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('desarrolladora.update', $i->id_desarrolladora) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="update{{ $i->id_desarrolladora }}">
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" maxlength="120"
                   value="{{ $mio ? old('nombre') : $i->nombre }}" placeholder="Nombre" required>
            @if ($mio) @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="pais" maxlength="80"
                   value="{{ $mio ? old('pais') : $i->pais }}" placeholder="País (opcional)">
            @if ($mio) @error('pais') <small class="text-danger">{{ $message }}</small> @enderror @endif
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
            $('#updateDesarrolladora{{ $i->id_desarrolladora }}').modal('show');
        });
    </script>
@endif