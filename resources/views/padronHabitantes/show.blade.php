@extends('layout.plantilla2')

@section('titulo', 'Padrón de Habitantes')

@section('tituloMain')
    Listado de Habitantes
@endsection

@section('contenido')
    @php
        $usuario = usuarioActual();
    @endphp
    <table>
        <thead>
            <tr>
                <th>ID Habitante</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Domicilio</th>
                <th>Código Postal</th>
                <th>Excluido</th>
                <th>Fecha Exclusión</th>
                <th>Observaciones</th>
                {{-- para que no se muestre en el rol lectura --}}
                @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                    <th>Editar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($padronHabitantes as $habitante)
                <tr>
                    <td>{{ $habitante->idHabitante }}</td>
                    <td>{{ $habitante->nombre }}</td>
                    <td>{{ $habitante->apellido1 }}</td>
                    <td>{{ $habitante->apellido2 }}</td>
                    <td>{{ $habitante->domicilioOriginal }}</td>
                    <td>{{ $habitante->codigoPostal }}</td>
                    <td>{{ $habitante->excluido }}</td>
                    <td>{{ $habitante->fechaExclusion }}</td>
                    <td>{{ $habitante->observaciones }}</td>
                    {{-- para que no se muestre en el rol lectura --}}
                    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                        <td>
                            <button type="button"
                                onclick="window.location='{{ route('padronHabitantes.edit', ['idHabitante' => $habitante->idHabitante]) }}'">
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
        {{ $padronHabitantes->links() }}
    </div>

    {{-- para que no se muestre en el rol lectura --}}
    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
        <div class="btnIndex">
            <a class="botonesIndex" href="{{ route('padronHabitantes.create') }}">Añadir habitante</a>
        </div>
    @endif
@endsection
