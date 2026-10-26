<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateCliente{{ $i->id_cliente }}">
    Actualizar
</button>

<div class="modal fade" id="updateCliente{{ $i->id_cliente }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('cliente.update', $i->id_cliente) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="update{{ $i->id_cliente }}">
        @php 
          $mio = old('form') === 'update' . $i->id_cliente; //los errores y los datos escritos aparezcan solo en el modal correcto true solo en el modal del cliente que falló, y en false en todos los demas
        @endphp 
        <div class="modal-body">
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="nombre" value="{{ $mio ? old('nombre') : $i->nombre }}" placeholder="Nombre" required> //muestra lo que escribiste. Si no, muestra el dato original del cliente
            @if ($mio) @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
            @endif
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="apellidos" value="{{ $mio ? old('apellidos') : $i->apellidos }}" placeholder="Apellidos" required>
            @if ($mio) @error('apellidos') <small class="text-danger">{{ $message }}</small> @enderror
            @endif
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="email" name="email" value="{{ $mio ? old('email') : $i->email }}" placeholder="Correo (opcional)">
            @if ($mio) @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            @endif
          </div>
          <div class="mb-2">
            <input class="form-control form-control-sm" type="text" name="telefono" maxlength="20" value="{{ $mio ? old('telefono') : $i->telefono }}" placeholder="Teléfono (opcional)">
            @if ($mio) @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror 
            @endif
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
            $('#updateCliente{{ $i->id_cliente }}').modal('show');
        });
    </script>
@endif