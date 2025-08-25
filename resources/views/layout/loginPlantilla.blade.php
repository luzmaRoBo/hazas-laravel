<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet"> --}}
</head>

<body class="body1">

    <header>
        <h1
            class="font-oswald m-8 text-oscuro uppercase text-3xl font-bold text-center md:text-4xl lg:text-5xl xl:text-6xl 2xl:text-7xl">
            hazas de la suerte de barbate</h1>
    </header>

    <main>
        <div class="sesiones">
            <h2 class="font-oswald text-verdeOscuro text-3xl font-bold text-center m-6 md:text-4xl xl:text-5xl">
                @yield('tituloSesiones')</h2>

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="errores">
                    {{ session('success') }}
                </div>
            @endif
            {{-- Flash si venimos de login fallido --}}
            @if (session('error'))
                <div class="errores">{{ session('error') }}</div>
            @endif

            @yield('contenido')
        </div>



    </main>

    {{-- <footer
        class="text-white flex flex-col justify-center items-end p-4 mt-4 text-1xl font-bold font-oswald lg:text-3xl 2xl:text-4xl">
        <p class="m-2">Luz María Rojas Bonachera</p>
        <p class="m-2">2ª DAW Horas de libre configuración</p>
    </footer> --}}

</body>

</html>
