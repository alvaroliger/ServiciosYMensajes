<x-app-layout>
    <!-- Eliminamos el x-slot name="header" para no reservar espacio arriba -->

    <!-- Contenedor que ocupa toda la pantalla -->
    <div class="relative w-full h-screen">
        <!-- Imagen de fondo con overlay oscuro -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ asset('images/paris.jpg') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        </div>

        <!-- Contenido centrado sobre la imagen -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-white">
            <h1 class="text-4xl font-bold mb-4">Bienvenido a tu Dashboard</h1>

            <!-- BOTÓN PARA IR A /services -->
            <a href="{{ route('services.index') }}"
               class="mt-6 px-6 py-3 bg-blue-500 text-black font-bold rounded-md hover:bg-blue-700 transition">
                ¿Quieres viajar al mejor precio? ¡Pulsa aquíhhhhhhhh!
            </a>
        </div>
    </div>
</x-app-layout>
