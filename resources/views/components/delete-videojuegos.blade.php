<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteVideojuego{{ $i->id_videojuego }}">
    Eliminar
</button>

<div class="modal fade" id="deleteVideojuego{{ $i->id_videojuego }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar videojuego</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('videojuego.delete', $i->id_videojuego) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          ¿Seguro que quieres eliminar <strong>{{ $i->titulo }}</strong>?
          <br><small class="text-muted">También se borrarán su inventario y sus relaciones con plataformas.</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>