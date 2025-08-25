@extends('layout.loginPlantilla')

@section('titulo', 'Registro')

@section('tituloSesiones', 'Registro de usuario')

@section('contenido')
    {{-- Flash si venimos de login fallido --}}
    {{-- @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif --}}

    <form method="POST" action="{{ route('registro.store') }}">
        @csrf

        <fieldset>
            <label>Usuario</label>
            <input type="text" name="usuario" value="{{ old('usuario') }}" required>
            @error('usuario')
              <div class="text-red-600">{{ $message }}</div>
            @enderror

            <label class="mt-4">Contraseña</label>
            <input type="password" name="pass" required>
            @error('pass')
              <div class="text-red-600">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="btn-fi mt-6">
            <button type="submit">Registrar</button>
            <button type="button" onclick="window.location='{{ route('login') }}'">
                Login
            </button>
        </fieldset>
    </form>
@endsection