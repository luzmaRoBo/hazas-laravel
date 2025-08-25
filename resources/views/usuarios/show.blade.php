@extends('layout.plantilla2')

@section('titulo', 'Usuarios')

@section('tituloMain')
    Listado de Usuarios
@endsection

@section('contenido')
    @php
        $usuarioActual = usuarioActual();
    @endphp
    <table>
        <thead>
            <tr>
                <th>ID Usuario</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Rol</th>
                {{-- para que no se muestre en el rol lectura --}}
                @if ($usuarioActual && in_array($usuarioActual->rol, ['root', 'modificación']))
                    <th>Editar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->idUsuario }}</td>
                    <td>{{ $usuario->usuario }}</td>
                    <td>{{ $usuario->pass }}</td>
                    <td>{{ $usuario->rol }}</td>
                    {{-- para que no se muestre en el rol lectura --}}
                    @if ($usuarioActual && in_array($usuarioActual->rol, ['root', 'modificación']))
                        <td>
                            <button type="button"
                                onclick="window.location='{{ route('usuarios.edit', ['idUsuario' => $usuario->idUsuario]) }}'">
                                ✏️
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
            <input type="hidden" name="pasaValor" id="pasaValor">
        </tbody>
    </table>
    <div class="pagination mt-4">
        {{ $usuarios->links() }}
    </div>

    {{-- para que no se muestre en el rol lectura --}}
    @if ($usuarioActual && in_array($usuarioActual->rol, ['root', 'modificación']))
        <div class="btnIndex">
            <a class="botonesIndex" href="{{ route('usuarios.create') }}">Formulario</a>
        </div>
    @endif
@endsection
