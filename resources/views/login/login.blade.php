@extends('layout.loginPlantilla')

@section('titulo', 'Login')

@section('tituloSesiones', 'Inicio de sesión')

@section('contenido')
    {{-- Flash de éxito o error --}}
    {{-- @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif --}}

    <form method="POST" action="{{ route('login.create') }}">
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
            <button type="submit">Iniciar</button>
            <button type="button" onclick="window.location='{{ route('registro') }}'">
                Registro
            </button>
        </fieldset>
    </form>
@endsection