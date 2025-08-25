@extends('layout.plantilla2')

@section('titulo', 'Sorteo')

@section('tituloMain')
    Formulario para añadir Sorteo
@endsection

@section('contenido')

    <form action="">
        <fieldset>

            <label for="idSorteo">Id Sorteo</label>
            <input type="text" id="idSorteo" name="idSorteo">

            <label for="idHabitante">Id Habitante</label>
            <input type="text" id="idHabitante" name="idHabitante">

            <label for="idHaza">Id Haza</label>
            <input type="text" id="idHaza" name="idHaza">

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">

        </fieldset>

        <fieldset class="btn-fi">
            <button class="btn-form" type="submit">Crear/Modificar</button>
            <a class="btn-volver" href="{{ route('sorteo.show') }}">Volver</a>
        </fieldset>
    </form>
@endsection
