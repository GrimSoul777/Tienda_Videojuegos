
@props(['i'])

<button type="button" class="btn btn-warning btn-sm"
    data-toggle="modal"
    data-target="#updateRol{{ $i->id_rol }}">
    Editar
</button>

<div class="modal fade" id="updateRol{{ $i->id_rol }}"
    tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar rol</h5>

                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('rol.update', $i->id_rol) }}"
                method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="form"
                    value="update{{ $i->id_rol }}">

                <div class="modal-body text-left">

                    <div class="form-group">
                        <label>Nombre del rol</label>
                        <input type="text" class="form-control"
                            name="nombre"
                            value="{{ old('form') === 'update' . $i->id_rol ? old('nombre') : $i->nombre }}"
                            maxlength="50" required>

                        @error('nombre')
                            @if (old('form') === 'update' . $i->id_rol)
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea class="form-control" name="descripcion"
                            maxlength="150" rows="3">{{ old('form') === 'update' . $i->id_rol ? old('descripcion') : $i->descripcion }}</textarea>

                        @error('descripcion')
                            @if (old('form') === 'update' . $i->id_rol)
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-warning">
                        Actualizar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@if ($errors->any() && old('form') === 'update' . $i->id_rol)
    <script>
        $(document).ready(function () {
            $('#updateRol{{ $i->id_rol }}').modal('show');
        });
    </script>
@endif
