<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <!-- Quitamos h-screen y overflow-hidden para permitir que la página crezca y tenga scroll -->
    <body class="font-sans antialiased relative min-h-screen">
        <x-banner />

        <!-- Imagen de fondo a pantalla completa -->
        <div
            class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('images/paris/paris.jpg') }}');"
        >
            <!-- Overlay semitransparente para oscurecer ligeramente la imagen (opcional) -->
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        </div>

        <!-- Contenedor principal, por encima del fondo (z-10) -->
        <div class="relative z-10 w-full min-h-screen flex flex-col">

            <!-- Barra de navegación Jetstream -->
            @livewire('navigation-menu')

            <!-- Encabezado de página (opcional) -->
            @if (isset($header))
                <!-- Si quieres un encabezado transparente, quita bg-white y shadow -->
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Contenido principal (ocupa todo el espacio disponible) -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
