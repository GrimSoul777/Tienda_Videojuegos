<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDesarrolladora{{ $i->id_desarrolladora }}">
    Eliminar
</button>

<div class="modal fade" id="deleteDesarrolladora{{ $i->id_desarrolladora }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar desarrolladora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('desarrolladora.delete', $i->id_desarrolladora) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body">
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