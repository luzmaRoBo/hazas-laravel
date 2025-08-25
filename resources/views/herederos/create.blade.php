@extends('layout.plantilla2')

@section('titulo', 'Hazas')

@section('tituloMain')
    Formulario para añadir Hazas
@endsection

@section('contenido')

    <form action="">
        <div class="pruebaForm">
            <fieldset>

                <label for="idHerederos">Id Herederos</label>
                <input type="text" id="idHerederos" name="idHerederos">

                <label for="idHabitante">Id Habitante</label>
                <input type="text" id="idHabitante" name="idHabitante">

                <label for="orden">Orden</label>
                <input type="text" id="orden" name="orden">

                <label for="apellido1">Apellido 1</label>
                <input type="text" id="apellido1" name="apellido1">

                <label for="apellido2">Apellido 2</label>
                <input type="text" id="apellido2" name="apellido2">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre">

                <label for="tipoDireccion">Tipo direccion</label>
                <select id="tipoDireccion" name="tipoDireccion">
                    <option value="calle">Calle</option>
                    <option value="avenida">Avenida</option>
                    <option value="plaza">Plaza</option>
                    <option value="otro">Otro</option>
                </select>

                <label for="nombreDireccion">Nombre direccion</label>
                <input type="text" id="nombreDireccion" name="nombreDireccion">
            </fieldset>
            <fieldset>
                <label for="numeroDireccion">Numero direccion</label>
                <input type="text" id="numeroDireccion" name="numeroDireccion">

                <label for="bloqueDireccion">Bloque de direccion</label>
                <input type="text" id="bloqueDireccion" name="bloqueDireccion">

                <label for="escaleraDireccion">Escalera Direccion</label>
                <input type="text" id="escaleraDireccion" name="escaleraDireccion">

                <label for="pisoDireccion">Piso Direccion</label>
                <input type="text" id="pisoDireccion" name="pisoDireccion">

                <label for="puertaDireccion">Puerta Direccion</label>
                <input type="text" id="puertaDireccion" name="puertaDireccion">

                <label for="codigoPostal">Codigo Postal</label>
                <input type="text" id="codigoPostal" name="codigoPostal">

                <label for="telefono">Telefono</label>
                <input type="tel" id="telefono" name="telefono">

                <label for="email">Email</label>
                <input type="email" id="email" name="email">

            </fieldset>
        </div>

        <fieldset class="btn-fi">
            <button class="btn-form" type="submit">Crear/Modificar</button>
            <a class="btn-volver" href="{{ route('padronHabitantes.show') }}">Volver</a>
        </fieldset>
    </form>
@endsection
