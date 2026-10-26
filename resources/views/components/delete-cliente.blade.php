<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCliente{{ $i->id_cliente }}">
    Eliminar
</button>

<div class="modal fade" id="deleteCliente{{ $i->id_cliente }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('cliente.delete', $i->id_cliente) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          ¿Seguro que quieres eliminar a <strong>{{ $i->nombre }} {{ $i->apellidos }}</strong>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>