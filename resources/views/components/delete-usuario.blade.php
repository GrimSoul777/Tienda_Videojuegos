@props(['i'])

<button type="button" class="btn btn-danger btn-sm"
    data-toggle="modal"
    data-target="#deleteUsuario{{ $i->id_usuario }}">
    Eliminar
</button>

<div class="modal fade" id="deleteUsuario{{ $i->id_usuario }}"
    tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content text-left">

            <div class="modal-header">
                <h5 class="modal-title">Eliminar usuario</h5>

                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('usuario.delete', $i->id_usuario) }}"
                method="post">

                @csrf
                @method('DELETE')

                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar al usuario
                    <strong>{{ $i->nombre }}</strong>?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Sí, eliminar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>