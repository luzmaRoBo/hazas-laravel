@extends('layout.plantilla2')

@section('titulo', 'Junta de Hazas')

@section('tituloMain')
    Formulario para añadir Junta de Hazas
@endsection

@section('contenido')
    @php
        $usuario = usuarioActual();
    @endphp

    <form method="POST"
        action="{{ isset($junta) ? route('juntaHazas.update', $junta->idJuntaHazas) : route('juntaHazas.store') }}">
        @csrf
        @isset($junta)
            @method('PUT')
        @endisset

        <div class="pruebaForm">
            <fieldset>

                <label for="idJuntaHazas">ID Junta de Hazas</label>
                <input type="text" id="idJuntaHazas" name="idJuntaHazas"
                    value="{{ old('idJuntaHazas', $junta->idJuntaHazas ?? '') }}" placeholder="Hasta 10 caracteres" required>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $junta->nombre ?? '') }}"
                    placeholder="Hasta 30 caracteres">

                <label for="apellido1">Primer Apellido</label>
                <input type="text" id="apellido1" name="apellido1"
                    value="{{ old('apellido1', $junta->apellido1 ?? '') }}" placeholder="Hasta 30 caracteres">

                <label for="apellido2">Segundo Apellido</label>
                <input type="text" id="apellido2" name="apellido2"
                    value="{{ old('apellido2', $junta->apellido2 ?? '') }}" placeholder="Hasta 30 caracteres">

                <label for="tipoParticipante">Tipo Participante</label>
                <select id="tipoParticipante" name="tipoParticipante">
                    @php
                        $tipos = ['alcalde', 'asociado', 'concejal'];
                        $valorActual = old('tipoParticipante', $junta->tipoParticipante ?? '');
                    @endphp
                    <option value="" {{ $valorActual === '' ? 'selected' : '' }}>Sin especificar</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo }}" {{ $valorActual === $tipo ? 'selected' : '' }}>
                            {{ ucfirst($tipo) }}
                        </option>
                    @endforeach
                </select>

            </fieldset>
        </div>

        <fieldset class="btn-fi">
            <button class="btn-form" type="submit">Crear/Modificar</button>
            <a class="btn-volver" href="{{ route('juntaHazas.show') }}">Volver</a>
        </fieldset>
    </form>


    {{-- Formulario de eliminar (solo si hay $junta y el usuario es root) --}}
    @isset($junta)
        @if ($usuario && $usuario->rol === 'root')
            <form action="{{ route('juntaHazas.destroy', $junta->idJuntaHazas) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar este miembro de la junta?');">
                @csrf
                @method('DELETE')

                <fieldset class="btn-fi">
                    <button class="btn-eliminar" type="submit">Eliminar</button>
                </fieldset>
            </form>
        @endif
    @endisset
@endsection
