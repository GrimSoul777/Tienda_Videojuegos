<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCategoria{{ $i->id_categoria }}">
    Eliminar
</button>

<div class="modal fade" id="deleteCategoria{{ $i->id_categoria }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categoria.delete', $i->id_categoria) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body text-left">
                    ¿Seguro que quieres eliminar <strong>{{ $i->nombre }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>