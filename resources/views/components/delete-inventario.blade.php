<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteInventario{{ $i->id_inventario }}">
    Eliminar
</button>

<div class="modal fade" id="deleteInventario{{ $i->id_inventario }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar registro de inventario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('inventario.delete', $i->id_inventario) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          ¿Seguro que quieres eliminar el inventario de <strong>{{ $i->videojuego->titulo ?? 'este videojuego' }}</strong>?
          <br><small class="text-muted">Está agotado</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>