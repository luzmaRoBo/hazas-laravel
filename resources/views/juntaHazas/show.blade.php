@extends('layout.plantilla2')

@section('titulo', 'Junta de Hazas')

@section('tituloMain')
    Listado de Junta de Hazas
@endsection

@section('contenido')
    @php
        $usuario = usuarioActual();
    @endphp

    <table>
        <thead>
            <tr>
                <th>ID Junta</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Tipo participante</th>
                @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                    <th>Editar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($juntaHazas as $juntaHaza)
                <tr>
                    <td>{{ $juntaHaza->idJuntaHazas }}</td>
                    <td>{{ $juntaHaza->nombre }}</td>
                    <td>{{ $juntaHaza->apellido1 }}</td>
                    <td>{{ $juntaHaza->apellido2 }}</td>
                    <td>{{ ucfirst($juntaHaza->tipoParticipante) }}</td>
                    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                        <td>
                            <button type="button"
                                onclick="window.location='{{ route('juntaHazas.edit', ['idJuntaHazas' => $juntaHaza->idJuntaHazas]) }}'">
                                ✏️
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination mt-4">
        {{ $juntaHazas->links() }}
    </div>

    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
        <div class="btnIndex">
            <a class="botonesIndex" href="{{ route('juntaHazas.create') }}">Añadir junta</a>
        </div>
    @endif
@endsection
