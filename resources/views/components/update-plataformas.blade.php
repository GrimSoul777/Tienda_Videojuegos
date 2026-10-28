@php $mio = old('form') === 'update' . $i->id_plataforma; @endphp
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updatePlataforma{{ $i->id_plataforma }}">
    Actualizar
</button>

<div class="modal fade" id="updatePlataforma{{ $i->id_plataforma }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar plataforma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('plataforma.update', $i->id_plataforma) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="update{{ $i->id_plataforma }}">
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" maxlength="255"
                   value="{{ $mio ? old('nombre') : $i->nombre }}" placeholder="Nombre" required>
            @if ($mio) @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="fabricante" maxlength="255"
                   value="{{ $mio ? old('fabricante') : $i->fabricante }}" placeholder="Fabricante (opcional)">
            @if ($mio) @error('fabricante') <small class="text-danger">{{ $message }}</small> @enderror @endif
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
            $('#updatePlataforma{{ $i->id_plataforma }}').modal('show');
        });
    </script>
@endif