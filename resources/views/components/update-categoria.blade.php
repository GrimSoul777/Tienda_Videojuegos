@php
    $mio = old('form') === 'update' . $i->id_categoria;
@endphp

<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateCategoria{{ $i->id_categoria }}">
    Actualizar
</button>

<div class="modal fade" id="updateCategoria{{ $i->id_categoria }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categoria.update', $i->id_categoria) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="form" value="update{{ $i->id_categoria }}">
                <div class="modal-body text-left">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nombre"
                            value="{{ $mio ? old('nombre') : $i->nombre }}">
                        @if ($mio) @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror @endif
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="descripcion" rows="2">{{ $mio ? old('descripcion') : $i->descripcion }}</textarea>
                        @if ($mio) @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($mio && $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#updateCategoria{{ $i->id_categoria }}').modal('show');
        });
    </script>
@endif