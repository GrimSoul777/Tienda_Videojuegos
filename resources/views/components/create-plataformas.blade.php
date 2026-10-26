<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPlataforma">
    Nueva plataforma
</button>

<div class="modal fade" id="createPlataforma" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Registrar plataforma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('plataforma.create') }}" method="post">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" maxlength="255"
                   value="{{ old('nombre') }}" placeholder="Nombre de la plataforma" required>
            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="fabricante" maxlength="255"
                   value="{{ old('fabricante') }}" placeholder="Fabricante (opcional)">
            @error('fabricante') <small class="text-danger">{{ $message }}</small> @enderror
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
            $('#createPlataforma').modal('show');
        });
    </script>
@endif