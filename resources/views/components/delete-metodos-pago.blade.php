<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteMetodoPago{{ $i->id_metodo_pago }}">
    Eliminar
</button>

<div class="modal fade" id="deleteMetodoPago{{ $i->id_metodo_pago }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar método de pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('metodopago.delete', $i->id_metodo_pago) }}" method="post">
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