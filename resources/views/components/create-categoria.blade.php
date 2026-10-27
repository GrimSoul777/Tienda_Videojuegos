<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoria">
    Nueva categoría
</button>

<div class="modal fade" id="createCategoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categoria.create') }}" method="post">
                @csrf
                <input type="hidden" name="form" value="create">
                <div class="modal-body text-left">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nombre"
                            value="{{ old('form') === 'create' ? old('nombre') : '' }}"
                            placeholder="Nombre de la categoría">
                        @if (old('form') === 'create')
                            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="descripcion" rows="2"
                        placeholder="Descripción (opcional)">{{ old('form') === 'create' ? old('descripcion') : '' }}</textarea>
                        @if (old('form') === 'create')
                            @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
                        @endif
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

@if (old('form') === 'create' && $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#createCategoria').modal('show');
        });
    </script>
@endif