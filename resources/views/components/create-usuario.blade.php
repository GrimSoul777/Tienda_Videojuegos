<button type="button" class="btn btn-primary"
    data-toggle="modal" data-target="#createUsuario">
    Nuevo usuario
</button>

<div class="modal fade" id="createUsuario" tabindex="-1"
    role="dialog" aria-labelledby="createUsuarioLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content text-left">

            <div class="modal-header">
                <h5 class="modal-title" id="createUsuarioLabel">
                    Registrar usuario
                </h5>

                <button type="button" class="close"
                    data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('usuario.create') }}" method="post">
                @csrf
                <input type="hidden" name="form" value="create">

                <div class="modal-body">

                    <div class="mb-2">
                        <input class="form-control form-control-sm"
                            type="text" name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Nombre" required>

                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input class="form-control form-control-sm"
                            type="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="Correo electrónico" required>

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <input class="form-control form-control-sm"
                            type="password" name="password"
                            placeholder="Contraseña" required>

                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <select class="form-control form-control-sm"
                            name="id_rol" required>

                            <option value="">Selecciona un rol</option>

                            @foreach (\App\Models\Rol::all() as $rol)
                                <option value="{{ $rol->id_rol }}"
                                    {{ old('id_rol') == $rol->id_rol ? 'selected' : '' }}>
                                    {{ $rol->nombre }}
                                </option>
                            @endforeach

                        </select>

                        @error('id_rol')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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

@if (old('form') === 'create' && $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#createUsuario').modal('show');
        });
    </script>
@endif