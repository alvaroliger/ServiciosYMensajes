@extends('layouts.paraExtends')

@section('content')
    <!-- Contenedor principal con modo oscuro -->
    <div x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', value => {
        localStorage.setItem('darkMode', value);
        document.documentElement.classList.toggle('dark', value);
    })" class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <!-- Botón para alternar modo oscuro/claro -->
        <div class="fixed top-4 right-4 z-50">
            <button @click="darkMode = !darkMode"
                class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-black dark:text-white p-2 rounded-full shadow transition">
                <template x-if="darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M3 12H1m16.95-7.05l-1.414 1.414
                                         M6.464 17.95l-1.414 1.414M16.95 20.95l-1.414-1.414
                                         M6.464 4.05L4.05 6.464" />
                    </svg>
                </template>
                <template x-if="!darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                    </svg>
                </template>
            </button>
        </div>

        <!-- Contenedor del contenido -->
        <div
            class="max-w-4xl mx-auto my-8 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-8 transition-colors duration-300">
            <div class="text-center mb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-blue-900 dark:text-blue-200 mb-2">
                    {{ $service->title }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Descubre un destino inolvidable con nosotros.
                </p>
            </div>

            <!-- Carrusel dinámico basado en rutas_fotos -->
            <div x-data="{ current: 1 }" class="max-w-3xl mx-auto mb-10 space-y-4">
                <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-md overflow-hidden">
                    @if ($fotos && count($fotos) > 0)
                        @foreach ($fotos as $index => $foto)
                            <img x-show="current === {{ $index + 1 }}" src="{{ asset($foto) }}"
                                class="w-full h-full object-cover transition-all duration-300 ease-in-out" />
                        @endforeach
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">
                            No hay imágenes disponibles para este servicio.
                        </p>
                    @endif
                </div>

                @if (count($fotos) > 1)
                    <div class="flex justify-between">
                        <button @click="current = (current === 1) ? {{ count($fotos) }} : (current - 1)"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                            Anterior
                        </button>
                        <button @click="current = (current === {{ count($fotos) }}) ? 1 : (current + 1)"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                            Siguiente
                        </button>
                    </div>

                    <div class="flex justify-center gap-2">
                        @foreach ($fotos as $index => $foto)
                            <div @click="current = {{ $index + 1 }}"
                                :class="current === {{ $index + 1 }} ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-500'"
                                class="w-3 h-3 rounded-full border border-gray-400 cursor-pointer">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Detalles -->
            <div class="space-y-3 text-gray-700 dark:text-gray-300 text-base sm:text-lg mb-12">
                <p><span class="font-semibold">Descripción:</span> {{ $service->description }}</p>
                <p><span class="font-semibold">Precio:</span> {{ $service->price }} €</p>
                <p><span class="font-semibold">Duración:</span> {{ $service->duration }} noches</p>
                <p><span class="font-semibold">Estado:</span>
                    @if ($service->status === 'activo')
                        <span class="text-green-600 dark:text-green-400 font-semibold">Activo</span>
                    @else
                        <span class="text-red-600 dark:text-red-400 font-semibold">Inactivo</span>
                    @endif
                </p>
            </div>

            <livewire:comentar-servicio :service-id="$service->id" />

            <!-- CTA final -->
            <div class="mt-8 py-6 bg-blue-600 rounded-lg text-center text-white">
                <h2 class="text-xl font-semibold">¿Te gustaría ir a este sitio?</h2>
                <p class="mt-2">¡Reserva ahora y deja todo en nuestras manos!</p>
                <a href="#"
                    class="inline-block mt-4 px-6 py-2 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition">
                    ¡Vámonos!
                </a>
                <a href="{{ route('services.index') }}"
                    class="inline-block mt-4 ml-3 px-6 py-2 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition">
                    Ver todos los viajes
                </a>
            </div>
        </div>
    </div>
@endsection
