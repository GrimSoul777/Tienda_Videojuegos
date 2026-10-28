<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createMetodoPago">
    Nuevo método de pago
</button>

<div class="modal fade" id="createMetodoPago" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Registrar método de pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('metodopago.create') }}" method="post">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" maxlength="50"
                   value="{{ old('nombre') }}" placeholder="Nombre (ej. Tarjeta, Efectivo)" required>
            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-2">
            <textarea class="form-control form-control-sm" name="descripcion" rows="2" maxlength="150"
                      placeholder="Descripción (opcional)">{{ old('descripcion') }}</textarea>
            @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
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
            $('#createMetodoPago').modal('show');
        });
    </script>
@endif