<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCliente">
    Nuevo cliente
</button>

<div class="modal fade" id="createCliente" tabindex="-1" role="dialog" aria-labelledby="createClienteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title" id="createClienteLabel">Registrar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('cliente.create') }}" method="post">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required>
            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="apellidos" value="{{ old('apellidos') }}" placeholder="Apellidos" required>
            @error('apellidos') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="email" name="email" value="{{ old('email') }}" placeholder="Correo (opcional)">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="tel" name="telefono" minlenght="10" maxlength="15" pattern="[0-9]{10,15}" value="{{ old('telefono') }}" placeholder="Teléfono (opcional)">
            @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror
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
            $('#createCliente').modal('show');
        });
    </script>
@endif