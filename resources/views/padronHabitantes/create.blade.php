@extends('layout.plantilla2')

@section('titulo', 'Padrón de Habitantes')

@section('tituloMain')
    Formulario para añadir Habitantes
@endsection

@section('contenido')
    {{-- para controlar roles --}}
    @php
        $usuario = usuarioActual();
    @endphp
    <form method="POST"
        action="{{ isset($habitante) ? route('padronHabitantes.update', $habitante->idHabitante) : route('padronHabitantes.store') }}">
        @csrf
        @isset($habitante)
            @method('PUT')
        @endisset
        @csrf
        <div class="pruebaForm">
            <fieldset>

                <label for="idHabitante">Id Habitante</label>
                <input type="text" name="idHabitante" value="{{ old('idHabitante', $habitante->idHabitante ?? '') }}"
                    placeholder="C60-00001 (hasta 10 caracteres alfanumericos)" required>

                <label for="apellido1">apellido1</label>
                <input type="text" name="apellido1" value="{{ old('apellido1', $habitante->apellido1 ?? '') }}"
                    placeholder="Apellido">

                <label for="apellido2">apellido2</label>
                <input type="text" name="apellido2" value="{{ old('apellido2', $habitante->apellido2 ?? '') }}"
                    placeholder="Apellido">

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $habitante->nombre ?? '') }}"
                    placeholder="Nombre">

                <label for="domicilio">Domicilio</label>
                <input type="text" name="domicilioOriginal"
                    value="{{ old('domicilioOriginal', $habitante->domicilioOriginal ?? '') }}"
                    placeholder="calle almadraba s/n">

                <label for="tipoDireccion">Tipo Direccion</label>
                <select name="tipoDireccion">
                    @php
                        $tipos = ['calle', 'avenida', 'plaza', 'carretera', 'camino', 'callejon'];
                    @endphp
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo }}"
                            {{ old('tipoDireccion', $habitante->tipoDireccion ?? '') == $tipo ? 'selected' : '' }}>
                            {{ ucfirst($tipo) }}
                        </option>
                    @endforeach
                </select>

                <label for="nombreDireccion">Nombre Direccion</label>
                <input type="text" name="nombreDireccion"
                    value="{{ old('nombreDireccion', $habitante->nombreDireccion ?? '') }}" placeholder="Almadraba">

                <label for="numeroDireccion">Numeo Direccion</label>
                <input type="text" name="numeroDireccion"
                    value="{{ old('numeroDireccion', $habitante->numeroDireccion ?? '') }}" placeholder="2">

            </fieldset>
            <fieldset>
                <label for="bloqueDireccion">Bloque direccion</label>
                <input type="text" name="bloqueDireccion"
                    value="{{ old('bloqueDireccion', $habitante->bloqueDireccion ?? '') }}" placeholder="B">

                <label for="escaleraDireccion">escaleraDireccion</label>
                <input type="text" name="escaleraDireccion"
                    value="{{ old('escaleraDireccion', $habitante->escaleraDireccion ?? '') }}" placeholder="A">

                <label for="piso">Piso Direccion</label>
                <input type="text" name="piso" value="{{ old('piso', $habitante->piso ?? '') }}" placeholder="2º">

                <label for="puerta">Puerta</label>
                <input type="text" name="puerta" value="{{ old('puerta', $habitante->puerta ?? '') }}" placeholder="C">

                <label for="CodigoPostal">Codigo Postal</label>
                <input type="text" name="codigoPostal" value="{{ old('codigoPostal', $habitante->codigoPostal ?? '') }}"
                    placeholder="11160">

                <div class="excluido">
                    <label for="excluido">Excluido</label>
                    <input type="checkbox" name="excluido" value="1"
                        {{ old('excluido', $habitante->excluido ?? false) ? 'checked' : '' }}>
                </div>

                <label for="fechaExclusion">Fecha exclusión</label>
                <input type="date" name="fechaExclusion"
                    value="{{ old('fechaExclusion', $habitante->fechaExclusion ?? '') }}">

                <label for="observaciones">observaciones</label>
                <textarea name="observaciones">{{ old('observaciones', $habitante->observaciones ?? '') }}</textarea>
            </fieldset>

        </div>

        <fieldset class="btn-fi">
            <button class="btn-form" type="submit">Crear/Modificar</button>
            <a class="btn-volver" href="{{ route('padronHabitantes.show') }}">Volver</a>
        </fieldset>
    </form>
    {{-- FORMULARIO DE ELIMINAR (solo si $habitante existe) --}}
    @isset($habitante)
        {{-- para que no se muestre en el rol lectura ni modificacion --}}
        @if ($usuario && $usuario->rol === 'root')
            <form action="{{ route('padronHabitantes.destroy', $habitante->idHabitante) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este habitante?');">
                @csrf
                @method('DELETE')

                <fieldset class="btn-fi">
                    <button class="btn-eliminar" type="submit">Eliminar</button>
                </fieldset>
            </form>
        @endif
    @endisset
@endsection
