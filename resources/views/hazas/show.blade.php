@extends('layout.plantilla2')

@section('titulo', 'Hazas')

@section('tituloMain')
    Listado de Hazas
@endsection

@section('contenido')
    @php
        $usuario = usuarioActual();
    @endphp
    <table>
        <thead>
            <tr>
                <th>ID Haza</th>
                <th>Nº Haza</th>
                <th>Partido</th>
                <th>Hectareas</th>
                <th>Renta anual</th>
                <th>Uso</th>
                <th>Localización</th>
                <th>Caballerizas</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                {{-- para que no se muestre en el rol lectura --}}
                @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                    <th>Editar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($hazas as $haza)
                <tr>
                    <td>{{ $haza->idHaza }}</td>
                    <td>{{ $haza->nHaza }}</td>
                    <td>{{ $haza->partido }}</td>
                    <td>{{ $haza->hectareas }}</td>
                    <td>{{ number_format($haza->rentaAnual, 2, ',', '.') }} €</td>
                    <td>{{ $haza->uso }}</td>
                    <td>{{ $haza->localizacion }}</td>
                    <td>{{ $haza->caballerizas }}</td>
                    <td>{{ $haza->fechaInicio }}</td>
                    <td>{{ $haza->fechaFin }}</td>
                    {{-- para que no se muestre en el rol lectura --}}
                    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
                        <td>
                            <button type="button"
                                onclick="window.location='{{ route('hazas.edit', ['idHaza' => $haza->idHaza]) }}'">
                                ✏️
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination mt-4">
        {{ $hazas->links() }}
    </div>

    {{-- para que no se muestre en el rol lectura --}}
    @if ($usuario && in_array($usuario->rol, ['root', 'modificación']))
        <div class="btnIndex">
            <a class="botonesIndex" href="{{ route('hazas.create') }}">Añadir haza</a>
        </div>
    @endif
@endsection
