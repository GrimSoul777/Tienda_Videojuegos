
@props(['i'])

<button type="button" class="btn btn-danger btn-sm"
    data-toggle="modal"
    data-target="#deleteRol{{ $i->id_rol }}">
    Eliminar
</button>

<div class="modal fade" id="deleteRol{{ $i->id_rol }}"
    tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Eliminar rol</h5>

                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar el rol
                <strong>{{ $i->nombre }}</strong>?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">
                    Cancelar
                </button>

                <form action="{{ route('rol.delete', $i->id_rol) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">
                        Confirmar eliminación
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
