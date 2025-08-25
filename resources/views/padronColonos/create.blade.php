@extends('layout.plantilla2')

@section('titulo', 'Colonos')

@section('tituloMain')
    Formulario para añadir Colonos
@endsection

@section('contenido')
    {{-- para controlar roles --}}
    @php
        $usuario = usuarioActual();
    @endphp
    <form method="POST" action="{{ isset($colono) ? route('colonos.update', $colono->idColono) : route('colonos.store') }}">
        @csrf
        @isset($colono)
            @method('PUT')
        @endisset
        <div class="pruebaForm">
            <fieldset>

                <label for="idColono">Id colono</label>
                <input type="text" id="idColono" name="idColono" value="{{ old('idColono', $colono->idColono ?? '') }}"
                    required placeholder="Ej.: C00012345 (hasta 10 caracteres alfanumericos)">

                <label for="apellido1">Apellido1</label>
                <input type="text" id="apellido1" name="apellido1"
                    value="{{ old('apellido1', $colono->apellido1 ?? '') }}" placeholder="apellido">

                <label for="apellido2">Apellido2</label>
                <input type="text" id="apellido2" name="apellido2"
                    value="{{ old('apellido2', $colono->apellido2 ?? '') }}" placeholder="apellido">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $colono->nombre ?? '') }}"
                    placeholder="nombre" required>

                <label for="apodo">Apodo</label>
                <input type="text" id="apodo" name="apodo" value="{{ old('apodo', $colono->apodo ?? '') }}"
                    placeholder="max. 30 caracteres">

                <label for="dni">Dni</label>
                <input type="text" id="dni" name="dni" value="{{ old('dni', $colono->dni ?? '') }}"
                    placeholder="11111111A">

                <label for="telefono">Telefono</label>
                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono', $colono->telefono ?? '') }}"
                    placeholder="666666666">

                <label for="email">Emain</label>
                <input type="email" id="email" name="email" value="{{ old('email', $colono->email ?? '') }}"
                    placeholder="ejemplo@correo.com">

                <label for="idJuntaHazas">Id Junta Hazas</label>
                <select name="idJuntaHazas" id="idJuntaHazas">
                    <option value="">-- Sin asignar --</option>
                    @foreach ($juntas as $j)
                        <option value="{{ $j->idJuntaHazas }}"
                            {{ old('idJuntaHazas', $colono->idJuntaHazas ?? '') == $j->idJuntaHazas ? 'selected' : '' }}>
                            {{ $j->idJuntaHazas }} - {{ $j->nombre }} {{ $j->apellido1 }}
                        </option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="idHabitante">Id Habitante</label>
                <select name="idHabitante" id="idHabitante">
                    <option value="">-- Selecciona un habitante --</option>
                    @foreach ($habitantes as $h)
                        <option value="{{ $h->idHabitante }}"
                            {{ old('idHabitante', $colono->idHabitante ?? '') == $h->idHabitante ? 'selected' : '' }}>
                            {{ $h->idHabitante }} - {{ $h->nombre }} {{ $h->apellido1 }}
                        </option>
                    @endforeach
                </select>

                <label for="tipoDireccion">Tipo direccion</label>
                <select id="tipoDireccion" name="tipoDireccion">
                    @php
                        $tipos = ['calle', 'avenida', 'plaza', 'carretera', 'camino', 'callejon'];
                        $valorActual = old('tipoDireccion', $colono->tipoDireccion ?? '');
                    @endphp

                    <option value="" {{ $valorActual === '' ? 'selected' : '' }}>
                        Sin especificar
                    </option>

                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo }}" {{ $valorActual === $tipo ? 'selected' : '' }}>
                            {{ ucfirst($tipo) }}
                        </option>
                    @endforeach
                </select>

                <label for="nombreDireccion">Nombre direccion</label>
                <input type="text" id="nombreDireccion" name="nombreDireccion"
                    value="{{ old('nombreDireccion', $colono->nombreDireccion ?? '') }}"
                    placeholder="max. 10 caracteres alfanumericos">

                <label for="numeroDireccion">Numero direccion</label>
                <input type="text" id="numeroDireccion" name="numeroDireccion"
                    value="{{ old('numeroDireccion', $colono->numeroDireccion ?? '') }}" placeholder="10">

                <label for="bloqueDireccion">Bloque de direccion</label>
                <input type="text" id="bloqueDireccion" name="bloqueDireccion"
                    value="{{ old('bloqueDireccion', $colono->bloqueDireccion ?? '') }}" placeholder="B">

                <label for="escaleraDireccion">Escalera Direccion</label>
                <input type="text" id="escaleraDireccion" name="escaleraDireccion"
                    value="{{ old('escaleraDireccion', $colono->escaleraDireccion ?? '') }}" placeholder="1">

                <label for="pisoDireccion">Piso Direccion</label>
                <input type="text" id="pisoDireccion" name="pisoDireccion"
                    value="{{ old('piso', $colono->piso ?? '') }}" placeholder="1º">

                <label for="puertaDireccion">Puerta Direccion</label>
                <input type="text" id="puertaDireccion" name="puertaDireccion"
                    value="{{ old('puerta', $colono->puerta ?? '') }}" placeholder="A">

                <label for="codigoPostal">Codigo Postal</label>
                <input type="text" id="codigoPostal" name="codigoPostal"
                    value="{{ old('codigoPostal', $colono->codigoPostal ?? '') }}" placeholder="11160">

            </fieldset>
        </div>

        <fieldset class="btn-fi">
            <button class="btn-form" type="submit">Crear/Modificar</button>
            <a class="btn-volver" href="{{ route('colonos.show') }}">Volver</a>
        </fieldset>
    </form>
    {{-- FORMULARIO DE ELIMINAR (solo si $colono existe) --}}
    @isset($colono)
        {{-- para que no se muestre en el rol lectura ni modificacion --}}
        @if ($usuario && $usuario->rol === 'root')
            <form action="{{ route('colonos.destroy', $colono->idColono) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este colono?');">
                @csrf
                @method('DELETE')

                <fieldset class="btn-fi">
                    <button class="btn-eliminar" type="submit">Eliminar</button>
                </fieldset>
            </form>
        @endif
    @endisset
@endsection
