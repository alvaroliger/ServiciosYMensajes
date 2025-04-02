<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @livewireStyles
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Solo scripts necesarios, sin estilos -->
    @vite(['resources/js/app.js']) {{-- Solo JS, sin CSS --}}
</head>

<body>
    @livewireScripts

    <!-- Banner opcional -->
    <x-banner />

    <!-- Menú de navegación de Livewire -->
    @livewire('navigation-menu')

    <!-- Encabezado opcional -->
    @if (isset($header))
        <header>
            <div>
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Contenido principal -->
    <main>
        @yield('content')
    </main>

    @stack('modals')
    @stack('scripts')
</body>
</html>
