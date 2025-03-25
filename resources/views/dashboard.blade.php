<x-app-layout>
    <!-- Contenedor de altura completa -->
    <div class="h-screen flex flex-col items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4">

        <h1 class="text-4xl font-bold mb-4">
            Bienvenido a tu Dashboard
        </h1>

        <p class="text-lg mb-6">
            Administra tus servicios y gestiona tus viajes fácilmente.
        </p>

        <a href="{{ route('services.index') }}"
        class="px-6 py-3 bg-white text-black font-bold rounded-md hover:bg-gray-200 transition">
         ¿Quieres viajar al mejor precio? ¡Pulsa aquí!
     </a>

    </div>
</x-app-layout>
