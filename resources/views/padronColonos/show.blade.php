@extends('layout.plantilla2')

@section('titulo', 'Padrón de Colonos')

@section('tituloMain')
    Listado de Colonos
@endsection

@section('contenido')
    @php
        $usuario = usuarioActual();
    @endphp
    <table>
        <thead>
            <tr>
                <th>ID Colono</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Domicilio</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Código Postal</th>
                <th>ID Habitante</th>
                <th>ID Junta</th>
                {{-- para que no se muestre en el rol lectura --}}
                @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                    <th>Editar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($padronColonos as $colono)
                <tr>
                    <td>{{ $colono->idColono }}</td>
                    <td>{{ $colono->nombre }}</td>
                    <td>{{ $colono->apellido1 }}</td>
                    <td>{{ $colono->apellido2 }}</td>
                    <td>{{ $colono->apodo }}</td>
                    <td>{{ $colono->dni }}</td>
                    <td>{{ $colono->telefono }}</td>
                    <td>{{ $colono->email }}</td>
                    <td>{{ $colono->codigoPostal }}</td>
                    <td>{{ $colono->idHabitante }}</td>
                    <td>{{ $colono->idJuntaHazas }}</td>
                    {{-- para que no se muestre en el rol lectura --}}
                    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                        <td>
                            <button type="button"
                                onclick='window.location="{{ route('colonos.edit', ['idColono' => $colono->idColono]) }}"'>
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
        {{ $padronColonos->links() }}
    </div>

    {{-- para que no se muestre en el rol lectura --}}
    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
        <div class="btnIndex">
            <a class="botonesIndex" href="{{ route('colonos.create') }}">Añadir colono</a>
        </div>
    @endif
@endsection
