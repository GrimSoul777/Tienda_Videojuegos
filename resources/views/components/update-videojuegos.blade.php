@php
    $mio = old('form') === 'update' . $i->id_videojuego;
    $marcadas = $mio ? old('plataformas', []) : $i->plataformas->pluck('id_plataforma')->all();
@endphp
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateVideojuego{{ $i->id_videojuego }}">
    Editar
</button>

<div class="modal fade" id="updateVideojuego{{ $i->id_videojuego }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-left">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar videojuego</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('videojuego.update', $i->id_videojuego) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="form" value="update{{ $i->id_videojuego }}">
        <div class="modal-body">

          <div class="form-group">
            <label class="small mb-1">Título</label>
            <input class="form-control form-control-sm" type="text" name="titulo" maxlength="150"
                   value="{{ $mio ? old('titulo') : $i->titulo }}" required>
            @if ($mio) @error('titulo') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>

          <div class="form-group">
            <label class="small mb-1">Descripción</label>
            <textarea class="form-control form-control-sm" name="descripcion" rows="2"
                      placeholder="Opcional">{{ $mio ? old('descripcion') : $i->descripcion }}</textarea>
            @if ($mio) @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror @endif
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="small mb-1">Precio</label>
              <input class="form-control form-control-sm" type="number" name="precio" min="0" max="99999999.99" step="0.01"
                     value="{{ $mio ? old('precio') : $i->precio }}" required>
              @if ($mio) @error('precio') <small class="text-danger">{{ $message }}</small> @enderror @endif
            </div>
            <div class="form-group col-md-6">
              <label class="small mb-1">Fecha de lanzamiento</label>
              <input class="form-control form-control-sm" type="date" name="fecha_lanzamiento"
                     value="{{ $mio ? old('fecha_lanzamiento') : $i->fecha_lanzamiento?->format('Y-m-d') }}">
              @if ($mio) @error('fecha_lanzamiento') <small class="text-danger">{{ $message }}</small> @enderror @endif
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="small mb-1">Categoría</label>
              @php $selC = $mio ? old('id_categoria') : $i->id_categoria; @endphp
              <select name="id_categoria" class="form-control form-control-sm" required>
                @foreach ($categorias as $c)
                  <option value="{{ $c->id_categoria }}" {{ $selC == $c->id_categoria ? 'selected' : '' }}>
                    {{ $c->nombre }}
                  </option>
                @endforeach
              </select>
              @if ($mio) @error('id_categoria') <small class="text-danger">{{ $message }}</small> @enderror @endif
            </div>
            <div class="form-group col-md-6">
              <label class="small mb-1">Desarrolladora</label>
              @php $selD = $mio ? old('id_desarrolladora') : $i->id_desarrolladora; @endphp
              <select name="id_desarrolladora" class="form-control form-control-sm" required>
                @foreach ($desarrolladoras as $d)
                  <option value="{{ $d->id_desarrolladora }}" {{ $selD == $d->id_desarrolladora ? 'selected' : '' }}>
                    {{ $d->nombre }}
                  </option>
                @endforeach
              </select>
              @if ($mio) @error('id_desarrolladora') <small class="text-danger">{{ $message }}</small> @enderror @endif
            </div>
          </div>

          <div class="form-group mb-0">
            <label class="small mb-1 d-block">Plataformas</label>
            @foreach ($plataformas as $p)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="plataformas[]"
                       id="uPlat{{ $i->id_videojuego }}_{{ $p->id_plataforma }}" value="{{ $p->id_plataforma }}"
                       {{ in_array($p->id_plataforma, $marcadas) ? 'checked' : '' }}>
                <label class="form-check-label" for="uPlat{{ $i->id_videojuego }}_{{ $p->id_plataforma }}">{{ $p->nombre }}</label>
              </div>
            @endforeach
            @if ($mio) @error('plataformas.*') <small class="text-danger d-block">{{ $message }}</small> @enderror @endif
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
            $('#updateVideojuego{{ $i->id_videojuego }}').modal('show');
        });
    </script>
@endif