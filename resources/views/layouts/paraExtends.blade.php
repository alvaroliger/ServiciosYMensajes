<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <head>
        @livewireStyles

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fuentes -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts y estilos (Tailwind, etc.) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <!-- Fondo degradado sin foto de París -->
    <body class="font-sans antialiased w-screen min-h-screen bg-gradient-to-b from-white to-gray-100 flex flex-col">

        <!-- Mensaje banner Jetstream (si lo usas) -->
        <x-banner />

        <!-- Menú de navegación (Jetstream Livewire) -->
        @livewire('navigation-menu')

        <!-- Encabezado de página (opcional) -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Contenido principal -->
        <main class="flex-grow">
            @yield('content')
        </main>

        @stack('modals')
        @livewireScripts
    </body>
</html>
