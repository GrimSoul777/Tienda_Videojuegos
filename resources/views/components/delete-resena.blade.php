@props(['i'])

<button type="button" class="btn btn-danger btn-sm"
    data-toggle="modal"
    data-target="#deleteResena{{ $i->id_resena }}">
    Eliminar
</button>

<div class="modal fade" id="deleteResena{{ $i->id_resena }}"
    tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Eliminar reseña</h5>

                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar la reseña
                <strong>#{{ $i->id_resena }}</strong>?

                <p class="mt-2 mb-0">
                    Esta acción no se puede deshacer.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">
                    Cancelar
                </button>

                <form action="{{ route('resena.delete', $i->id_resena) }}"
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