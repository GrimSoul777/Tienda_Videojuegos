
<button type="button" class="btn btn-success"
    data-toggle="modal" data-target="#createRol">
    Crear rol
</button>

<div class="modal fade" id="createRol" tabindex="-1"
    role="dialog" aria-labelledby="createRolLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createRolLabel">
                    Registrar rol
                </h5>

                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('rol.create') }}" method="POST">
                @csrf
                <input type="hidden" name="form" value="create">

                <div class="modal-body text-left">

                    <div class="form-group">
                        <label for="nombre">Nombre del rol</label>
                        <input type="text" class="form-control"
                            id="nombre" name="nombre"
                            value="{{ old('form') === 'create' ? old('nombre') : '' }}"
                            maxlength="50" required>

                        @error('nombre')
                            @if (old('form') === 'create')
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion"
                            name="descripcion" maxlength="150" rows="3">{{ old('form') === 'create' ? old('descripcion') : '' }}</textarea>

                        @error('descripcion')
                            @if (old('form') === 'create')
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-success">
                        Guardar rol
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@if ($errors->any() && old('form') === 'create')
    <script>
        $(document).ready(function () {
            $('#createRol').modal('show');
        });
    </script>
@endif
