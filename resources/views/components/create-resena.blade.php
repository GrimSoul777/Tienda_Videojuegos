@props(['videojuegos'])

<button type="button" class="btn btn-success"
    data-toggle="modal" data-target="#createResena">
    Crear reseña
</button>

<div class="modal fade" id="createResena" tabindex="-1"
    role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Registrar reseña</h5>

                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('resena.create') }}" method="POST">
                @csrf
                <input type="hidden" name="form" value="create">

                <div class="modal-body text-left">

                    <div class="form-group">
                        <label>Videojuego</label>
                        <select name="id_videojuego" class="form-control" required>
                            <option value="">Selecciona un videojuego</option>

                            @foreach ($videojuegos as $videojuego)
                                <option value="{{ $videojuego->id_videojuego }}"
                                    {{ old('form') === 'create' && old('id_videojuego') == $videojuego->id_videojuego ? 'selected' : '' }}>
                                    {{ $videojuego->titulo }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_videojuego')
                            @if (old('form') === 'create')
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Calificación</label>
                        <select name="calificacion" class="form-control" required>
                            <option value="">Selecciona una calificación</option>

                            @for ($n = 1; $n <= 5; $n++)
                                <option value="{{ $n }}"
                                    {{ old('form') === 'create' && old('calificacion') == $n ? 'selected' : '' }}>
                                    {{ $n }} / 5
                                </option>
                            @endfor
                        </select>

                        @error('calificacion')
                            @if (old('form') === 'create')
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Comentario</label>
                        <textarea name="comentario" class="form-control"
                            rows="3">{{ old('form') === 'create' ? old('comentario') : '' }}</textarea>

                        @error('comentario')
                            @if (old('form') === 'create')
                                <small class="text-danger">{{ $message }}</small>
                            @endif
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-success">
                        Guardar reseña
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@if ($errors->any() && old('form') === 'create')
    <script>
        $(document).ready(function () {
            $('#createResena').modal('show');
        });
    </script>
@endif