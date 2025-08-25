@extends('layout.plantilla2')

@section('titulo', 'Hazas')

@section('tituloMain')
    Formulario para añadir Hazas
@endsection

@section('contenido')
    {{-- para controlar roles --}}
    @php
        $usuario = usuarioActual();
    @endphp

    <form method="POST" action="{{ isset($haza) ? route('hazas.update', $haza->idHaza) : route('hazas.store') }}">
        @csrf
        @isset($haza)
            @method('PUT')
        @endisset
        <div class="pruebaForm">
            <fieldset>
                <label for="idHaza">Id Haza</label>
                <input type="text" id="idHaza" name="idHaza" value="{{ old('idHaza', $haza->idHaza ?? '') }}" required
                    placeholder="AGLH1C1S678 (hasta 15 caracteres alfanum.)">

                <label for="nHaza">Nº Haza</label>
                <input type="text" id="nHaza" name="nHaza" value="{{ old('nHaza', $haza->nHaza ?? '') }}" required
                    placeholder="Hasta 10 caracteres numéricos">

                <label for="partido">Partido</label>
                <select id="partido" name="partido">
                    @php
                        $partidos = [
                            'Manzanete',
                            'Bujar',
                            'Marmosilla',
                            'Algar',
                            'Cantarranas',
                            'Compradizas',
                            'El Águila',
                            'Las Corderas',
                        ];
                        $valorActual = old('partido', $haza->partido ?? '');
                    @endphp
                    <option value="" {{ $valorActual === '' ? 'selected' : '' }}>
                        Sin especificar
                    </option>
                    @foreach ($partidos as $p)
                        <option value="{{ $p }}"
                            {{ old('partido', $haza->partido ?? '') === $p ? 'selected' : '' }}>
                            {{ $p }}
                        </option>
                    @endforeach
                </select>

                <label for="hectareas">Hectáreas</label>
                <input type="number" step="0.01" id="hectareas" name="hectareas"
                    value="{{ old('hectareas', $haza->hectareas ?? '') }}" placeholder="12.5 ">

                <label for="rentaAnual">Valor (Renta Anual)</label>
                <input type="number" step="0.01" id="rentaAnual" name="rentaAnual"
                    value="{{ old('rentaAnual', $haza->rentaAnual ?? '') }}" placeholder="100.5">
            </fieldset>
            <fieldset>
                <label for="uso">Uso</label>
                <select id="uso" name="uso">
                    @php
                        $usos = ['Cultivo', 'Arrendamiento', 'Venta', 'Militar'];
                        $valorActual = old('uso', $haza->uso ?? '');
                    @endphp
                    {{-- Opción vacía para dejar uso en NULL --}}
                    <option value="" {{ $valorActual === '' ? 'selected' : '' }}>
                        Sin especificar
                    </option>
                    @foreach ($usos as $u)
                        <option value="{{ $u }}" {{ old('uso', $haza->uso ?? '') === $u ? 'selected' : '' }}>
                            {{ $u }}
                        </option>
                    @endforeach
                </select>

                <label for="localizacion">Localización</label>
                <input type="text" id="localizacion" name="localizacion"
                    value="{{ old('localizacion', $haza->localizacion ?? '') }}" placeholder="Max. 50 caracteres de texto">

                <label for="caballerizas">Caballerizas</label>
                <input type="text" id="caballerizas" name="caballerizas"
                    value="{{ old('caballerizas', $haza->caballerizas ?? '') }}"
                    placeholder="Max. 50 caracteres de alfanumericos">

                <label for="fechaInicio">Fecha Inicio</label>
                <input type="date" id="fechaInicio" name="fechaInicio"
                    value="{{ old('fechaInicio', $haza->fechaInicio ?? '') }}">

                <label for="fechaFin">Fecha Fin</label>
                <input type="date" id="fechaFin" name="fechaFin" value="{{ old('fechaFin', $haza->fechaFin ?? '') }}">
            </fieldset>
        </div>

        <fieldset class="btn-fi">
            <button class="btn-form" type="submit">Crear/Modificar</button>
            <a class="btn-volver" href="{{ route('hazas.show') }}">Volver</a>
        </fieldset>
    </form>
    {{-- FORMULARIO DE ELIMINAR (solo si $haza existe) --}}
    @isset($haza)
        {{-- para que no se muestre en el rol lectura ni modificacion --}}
        @if ($usuario && $usuario->rol === 'root')
            <form action="{{ route('hazas.destroy', $haza->idHaza) }}" method="POST"
                onsubmit="return confirm('¿Seguro que deseas eliminar esta haza?');">
                @csrf
                @method('DELETE')

                <fieldset class="btn-fi">
                    <button class="btn-eliminar" type="submit">Eliminar</button>
                </fieldset>
            </form>
        @endif
    @endisset
@endsection
