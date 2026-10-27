<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVideojuego">
    Nuevo videojuego
</button>

<div class="modal fade" id="createVideojuego" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Registrar videojuego</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('videojuego.create') }}" method="post">
        @csrf
        <input type="hidden" name="form" value="create">
        <div class="modal-body">

          @if ($categorias->isEmpty() || $desarrolladoras->isEmpty())
            <div class="alert alert-warning py-2">
              Necesitas al menos una categoría y una desarrolladora registradas para crear un videojuego.
            </div>
          @endif

          <div class="form-group">
            <label class="small mb-1">Título</label>
            <input class="form-control form-control-sm" type="text" name="titulo" maxlength="150"
                   value="{{ old('titulo') }}" required>
            @error('titulo') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="form-group">
            <label class="small mb-1">Descripción</label>
            <textarea class="form-control form-control-sm" name="descripcion" rows="2"
                      placeholder="Opcional">{{ old('descripcion') }}</textarea>
            @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="small mb-1">Precio</label>
              <input class="form-control form-control-sm" type="number" name="precio" min="0" max="99999999.99" step="0.01"
                     value="{{ old('precio') }}" required>
              @error('precio') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group col-md-6">
              <label class="small mb-1">Fecha de lanzamiento</label>
              <input class="form-control form-control-sm" type="date" name="fecha_lanzamiento"
                     value="{{ old('fecha_lanzamiento') }}">
              @error('fecha_lanzamiento') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="small mb-1">Categoría</label>
              <select name="id_categoria" class="form-control form-control-sm" required>
                <option value="">Selecciona...</option>
                @foreach ($categorias as $c)
                  <option value="{{ $c->id_categoria }}" {{ old('id_categoria') == $c->id_categoria ? 'selected' : '' }}>
                    {{ $c->nombre }}
                  </option>
                @endforeach
              </select>
              @error('id_categoria') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group col-md-6">
              <label class="small mb-1">Desarrolladora</label>
              <select name="id_desarrolladora" class="form-control form-control-sm" required>
                <option value="">Selecciona...</option>
                @foreach ($desarrolladoras as $d)
                  <option value="{{ $d->id_desarrolladora }}" {{ old('id_desarrolladora') == $d->id_desarrolladora ? 'selected' : '' }}>
                    {{ $d->nombre }}
                  </option>
                @endforeach
              </select>
              @error('id_desarrolladora') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="form-group mb-0">
            <label class="small mb-1 d-block">Plataformas</label>
            @php $marcadas = old('plataformas', []); @endphp
            @forelse ($plataformas as $p)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="plataformas[]"
                       id="cPlat{{ $p->id_plataforma }}" value="{{ $p->id_plataforma }}"
                       {{ in_array($p->id_plataforma, $marcadas) ? 'checked' : '' }}>
                <label class="form-check-label" for="cPlat{{ $p->id_plataforma }}">{{ $p->nombre }}</label>
              </div>
            @empty
              <small class="text-muted">Aún no hay plataformas registradas.</small>
            @endforelse
            @error('plataformas') <small class="text-danger d-block">{{ $message }}</small> @enderror
            @error('plataformas.*') <small class="text-danger d-block">{{ $message }}</small> @enderror
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
            $('#createVideojuego').modal('show');
        });
    </script>
@endif