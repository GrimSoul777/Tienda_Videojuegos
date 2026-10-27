<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteVenta{{ $i->id_venta }}">
    Eliminar
</button>

<div class="modal fade" id="deleteVenta{{ $i->id_venta }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('venta.delete', $i->id_venta) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          ¿Seguro que quieres eliminar la venta <strong>#{{ $i->id_venta }}</strong>
          por <strong>${{ number_format($i->total, 2) }}</strong>?
          <br><small class="text-muted">Los videojuegos vendidos regresarán al inventario.</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Sí, eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>