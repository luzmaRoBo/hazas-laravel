@extends('layout.plantilla2')

@section('titulo', 'Usuarios')

@section('tituloMain')
    Formulario para añadir Usuarios
@endsection

@section('contenido')
    {{-- para controlar roles --}}
    @php
        $usuarioActual = usuarioActual();
    @endphp
    <form method="POST"
        action="{{ isset($usuario) ? route('usuarios.update', $usuario->idUsuario) : route('usuarios.store') }}">
        @csrf
        @isset($usuario)
            @method('PUT')
        @endisset
        <div class="pruebaForm">
            <fieldset>

                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" value="{{ old('usuario', $usuario->usuario ?? '') }}"
                    placeholder="hasta 50 caracteres alfanuméricos">

                <label for="pass">Contraseña</label>
                <input type="password" id="pass" name="pass" placeholder="caracteres alfanuméricos">

                <label for="rol">Rol</label>
                <select id="rol" name="rol">
                    @php
                        $roles = ['root', 'lectura', 'modificación'];
                        $valorActual = old('rol', $usuario->rol ?? '');
                    @endphp

                    @foreach ($roles as $r)
                        <option value="{{ $r }}" {{ $valorActual === $r ? 'selected' : '' }}>
                            {{ ucfirst($r) }}
                        </option>
                    @endforeach
                </select>

            </fieldset>
        </div>
        <fieldset class="btn-fi">
            <button class="btn-form" type="submit">Crear/Modificar</button>
            <a class="btn-volver" href="{{ route('usuarios.show') }}">Volver</a>
        </fieldset>
    </form>
    {{-- FORMULARIO DE ELIMINAR (solo si $haza existe) --}}
    @isset($usuario)
        {{-- para que no se muestre en el rol lectura ni modificacion --}}
        @if ($usuarioActual && $usuarioActual->rol === 'root')
            <form action="{{ route('usuarios.destroy', $usuario->idUsuario) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                @csrf
                @method('DELETE')

                <fieldset class="btn-fi">
                    <button class="btn-eliminar" type="submit">Eliminar</button>
                </fieldset>
            </form>
        @endif
    @endisset
@endsection
