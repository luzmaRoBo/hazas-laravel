@extends('layout.plantilla2')

@section('titulo', 'Herederos')

@section('tituloMain')
    Listado de Herederos
@endsection

@section('contenido')
    <table>
        <thead>
            <tr>
                <th>ID Heredero</th>
                <th>ID Habitante</th>
                <th>Orden</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Nombre Dirección</th>
                <th>Codigo Postal</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($herederos as $heredero)
                <tr>
                    <td>{{ $heredero->idHeredero }}</td>
                    <td>{{ $heredero->idHabitante }}</td>
                    <td>{{ $heredero->orden }}</td>
                    <td>{{ $heredero->nombre }}</td>
                    <td>{{ $heredero->apellido1 }}</td>
                    <td>{{ $heredero->apellido2 }}</td>
                    <td>{{ $heredero->nombreDireccion }}</td>
                    <td>{{ $heredero->codigoPostal }}</td>
                    <td>{{ $heredero->telefono }}</td>
                    <td>{{ $heredero->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination mt-4">
        {{$herederos->links()}}
    </div>
        

    <div class="btnIndex">
        <a class="botonesIndex" href="{{ route('herederos.create') }}">Formulario</a>
    </div>
@endsection