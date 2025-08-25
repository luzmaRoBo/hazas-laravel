@extends('layout.plantilla2')

@section('titulo', 'Sorteo')

@section('tituloMain')
    Listado de Sorteos
@endsection

@section('contenido')
    <table>
        <thead>
            <tr>
                <th>idSorteo</th>
                <th>idHabitante</th>
                <th>idHaza</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sorteos as $sorteo)
                <tr onclick="cargarValor('{{ $sorteo->idSorteo }}')">
                    <td>{{ $sorteo->idSorteo }}</td>
                    <td>{{ $sorteo->idHabitante }}</td>
                    <td>{{ $sorteo->idHaza }}</td>
                    <td>{{ $sorteo->fecha }}</td>
                </tr>
            @endforeach
            <input type="hidden" name="pasaValor" id="pasaValor">
        </tbody>
    </table>
    <div class="pagination mt-4">
        {{$sorteos->links()}}
    </div>
        

    <div class="btnIndex">
        <a class="botonesIndex" href="{{ route('sorteo.create') }}">Añadir sorteo</a>
    </div>

@endsection