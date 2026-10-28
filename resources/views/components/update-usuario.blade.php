@props(['i'])

<button type="button" class="btn btn-warning btn-sm"
    data-toggle="modal" data-target="#updateUsuario{{ $i->id_usuario }}">
    Actualizar
</button>

<div class="modal fade" id="updateUsuario{{ $i->id_usuario }}"
    tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content text-left">

            <div class="modal-header">
                <h5 class="modal-title">Actualizar usuario</h5>

                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('usuario.update', $i->id_usuario) }}"
                method="post">

                @csrf
                @method('PUT')

                <input type="hidden" name="form"
                    value="update{{ $i->id_usuario }}">

                @php
                    $mio = old('form') === 'update' . $i->id_usuario;
                @endphp

                <div class="modal-body">

                    <div class="mb-2">
                        <input class="form-control form-control-sm"
                            type="text" name="nombre"
                            value="{{ $mio ? old('nombre') : $i->nombre }}"
                            placeholder="Nombre" required>

                        @if ($mio)
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif
                    </div>

                    <div class="mb-2">
                        <input class="form-control form-control-sm"
                            type="email" name="email"
                            value="{{ $mio ? old('email') : $i->email }}"
                            placeholder="Correo electrónico" required>

                        @if ($mio)
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif
                    </div>

                    <div class="mb-2">
                        <input class="form-control form-control-sm"
                            type="password" name="password"
                            placeholder="Nueva contraseña (opcional)">

                        <small class="text-muted">
                            Déjala vacía si no deseas cambiar la contraseña.
                        </small>

                        @if ($mio)
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif
                    </div>

                    <div class="mb-2">
                        <select class="form-control form-control-sm"
                            name="id_rol" required>

                            <option value="">Selecciona un rol</option>

                            @foreach (\App\Models\Rol::all() as $rol)
                                <option value="{{ $rol->id_rol }}"
                                    {{ ($mio ? old('id_rol') : $i->id_rol) == $rol->id_rol ? 'selected' : '' }}>
                                    {{ $rol->nombre }}
                                </option>
                            @endforeach

                        </select>

                        @if ($mio)
                            @error('id_rol')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">
                        Cerrar
                    </button>

                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@if ($mio && $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#updateUsuario{{ $i->id_usuario }}').modal('show');
        });
    </script>
@endif