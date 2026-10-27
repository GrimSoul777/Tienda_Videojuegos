
@props(['i'])

<button type="button" class="btn btn-warning btn-sm"
    data-toggle="modal"
    data-target="#updateResena{{ $i->id_resena }}">
    Editar
</button>

<div class="modal fade" id="updateResena{{ $i->id_resena }}"
    tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar reseña</h5>

                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('resena.update', $i->id_resena) }}"
                method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="form"
                    value="update{{ $i->id_resena }}">

                <div class="modal-body text-left">

                    <p>
                        <strong>Usuario:</strong>
                        {{ $i->usuario?->nombre ?? 'Sin usuario' }}
                    </p>

                    <p>
                        <strong>Videojuego:</strong>
                        {{ $i->videojuego?->titulo ?? 'Sin videojuego' }}
                    </p>

                    <div class="form-group">
                        <label>Calificación</label>

                        <select name="calificacion" class="form-control" required>
                            @for ($n = 1; $n <= 5; $n++)
                                <option value="{{ $n }}"
                                    {{ (old('form') === 'update' . $i->id_resena
                                        ? old('calificacion')
                                        : $i->calificacion) == $n ? 'selected' : '' }}>
                                    {{ $n }} / 5
                                </option>
                            @endfor
                        </select>

                        @error('calificacion')
                            @if (old('form') === 'update' . $i->id_resena)
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Comentario</label>

                        <textarea name="comentario" class="form-control"
                            rows="3">{{ old('form') === 'update' . $i->id_resena ? old('comentario') : $i->comentario }}</textarea>

                        @error('comentario')
                            @if (old('form') === 'update' . $i->id_resena)
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-warning">
                        Actualizar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@if ($errors->any() && old('form') === 'update' . $i->id_resena)
    <script>
        $(document).ready(function () {
            $('#updateResena{{ $i->id_resena }}').modal('show');
        });
    </script>
@endif
