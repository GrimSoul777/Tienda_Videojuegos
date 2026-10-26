<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createDesarrolladora">
    Nueva desarrolladora
</button>

<div class="modal fade" id="createDesarrolladora" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Registrar desarrolladora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('desarrolladora.create') }}" method="post">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" maxlength="120"
                   value="{{ old('nombre') }}" placeholder="Nombre de la desarrolladora" required>
            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="pais" maxlength="80"
                   value="{{ old('pais') }}" placeholder="País (opcional)">
            @error('pais') <small class="text-danger">{{ $message }}</small> @enderror
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
            $('#createDesarrolladora').modal('show');
        });
    </script>
@endif