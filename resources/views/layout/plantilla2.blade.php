<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet"> --}}
</head>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        /*seleccionamos el icono del menu*/
        const iconoMenu = document.querySelector('li.icono > a');
        /*evento al hacer click en el icono de menu*/
        iconoMenu.addEventListener('click', function(e) {
            // Evita que el enlace navegue
            e.preventDefault();
            /*guarda el li padre */
            const li = this.parentElement;
            // Alternar clase open con la que tenga para mostrar u ocultar
            li.classList.toggle('open');
        });
    });
</script>

<body class="bg-[rgba(194,197,170,0.2)] body2">

    <header class="header2">
        <h1
            class="font-oswald m-8 uppercase text-white text-2xl font-bold text-center custom-stroke md:text-4xl lg:text-5xl xl:text-6xl 2xl:text-7xl">
            hazas de la suerte de barbate</h1>
    </header>

    <nav class="w-[100%] font-oswald">
        <ul class="menu1">
            <li class="icono"><a href="#">Menú<span class="m-6">&#9776;</span></a>
                <ul class="submenu">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li><a href="{{ route('hazas.show') }}">Hazas</a></li>
                    <li><a href="{{ route('padronHabitantes.show') }}">Padrón de habitantes</a></li>
                    <li><a href="{{ route('juntaHazas.show') }}">Junta de hazas</a></li>
                    <li><a href="{{ route('colonos.show') }}">Padrón de colonos</a></li>
                    {{-- <li><a href="{{ route('herederos.show') }}">Herederos</a></li> --}}
                    {{-- <li><a href="{{ route('sorteo.show') }}">Sorteo</a></li> --}}
                    <li><a href="{{ route('usuarios.show') }}">Usuarios</a></li>
                </ul>
            </li>
        </ul>
        <ul>
            @php
                $usuario = usuarioActual();
            @endphp

            @if ($usuario)
                <div class="text-center my-2">
                    <p class="text-white text-base md:text-lg xl:text-xl 2xl:text-2xl font-semibold mb-2">
                        Bienvenid@, {{ $usuario->usuario }}
                    </p>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-[100%] mx-auto bg-white rounded-[5px] text-base font-bold text-oscuro p-[5px] border-2 border-oscuro md:text-lg xl:text-xl 2xl:text-2xl">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            @endif
        </ul>
    </nav>

    <main class="main2">

        <h2 class="font-oswald text-verdeOscuro text-3xl font-bold text-center m-6 md:text-4xl xl:text-5xl">
            @yield('tituloMain')</h2>
        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="errores">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="errores">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="divTablas">@yield('contenido')<div>



    </main>

    {{-- <footer
        class="text-verdeOscuro flex flex-col justify-center items-end p-4 mt-4 text-lg font-bold font-oswald lg:text-xl 2xl:text-2xl">
        <p class="m-2">Luz María Rojas Bonachera</p>
        <p class="m-2">2ª DAW Horas de libre configuración</p>
    </footer> --}}

</body>

</html>
