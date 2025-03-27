@extends('layouts.paraExtends')

@section('content')
    <!-- Contenedor principal con modo oscuro -->
    <div x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', value => {
        localStorage.setItem('darkMode', value);
        document.documentElement.classList.toggle('dark', value);
    })" class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <!-- Botón para alternar modo oscuro/claro (fijo arriba a la derecha) -->
        <div class="fixed top-4 right-4 z-50">
            <button @click="darkMode = !darkMode"
                class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-black dark:text-white p-2 rounded-full shadow transition">
                <!-- Icono de Sol (cuando está en modo oscuro) -->
                <template x-if="darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M3 12H1m16.95-7.05l-1.414 1.414
                                                                         M6.464 17.95l-1.414 1.414M16.95 20.95l-1.414-1.414
                                                                         M6.464 4.05L4.05 6.464" />
                    </svg>
                </template>
                <!-- Icono de Luna (cuando está en modo claro) -->
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

            <!-- Carrusel -->
            <div x-data="{ current: 1 }" class="max-w-3xl mx-auto mb-10 space-y-4">
                <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-md overflow-hidden">
                    <img x-show="current === 1" src="/images/costarica/costarica1.jpg" class="w-full h-full object-cover" />
                    <img x-show="current === 2" src="/images/costarica/costarica2.jpg" class="w-full h-full object-cover" />
                    <img x-show="current === 3" src="/images/costarica/costarica3.jpg" class="w-full h-full object-cover" />
                    <img x-show="current === 4" src="/images/costarica/costarica4.jpg" class="w-full h-full object-cover" />
                    <img x-show="current === 5" src="/images/costarica/costarica5.jpg" class="w-full h-full object-cover" />
                </div>

                <div class="flex justify-between">
                    <button @click="current = (current === 1) ? 5 : (current - 1)"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                        Anterior
                    </button>
                    <button @click="current = (current === 5) ? 1 : (current + 1)"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                        Siguiente
                    </button>
                </div>

                <div class="flex justify-center gap-2">
                    <template x-for="i in 5" :key="i">
                        <div @click="current = i" :class="current === i ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-500'"
                            class="w-3 h-3 rounded-full border border-gray-400 cursor-pointer">
                        </div>
                    </template>
                </div>
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

            <!-- Comentarios -->
            <div x-data="{ showAll: false }">
                <h2 class="text-2xl font-bold text-blue-900 dark:text-blue-200 mb-4">Comentarios</h2>

                @php
                    $totalComments = $service->messages->count();
                @endphp

                @forelse($service->messages as $index => $message)
                    @if (auth()->check() && auth()->user()->id === $message->user->id)
                        <!-- Mensaje enviado por el usuario (alineado a la derecha) -->
                        <div x-show="showAll || {{ $index }} < 4" class="mb-6 flex justify-end">
                            <div
                                class="p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 rounded-lg shadow-sm transition max-w-xs break-words whitespace-normal">
                                <p class="text-sm mb-1 text-right">Tú</p>
                                <p class="text-right break-words whitespace-normal">
                                    {{ $message->body }}
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Mensaje de otros usuarios (alineado a la izquierda) -->
                        <div x-show="showAll || {{ $index }} < 4" class="mb-6 flex justify-start">
                            <div
                                class="p-4 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm transition max-w-xs break-words whitespace-normal">
                                <p class="text-sm mb-1">{{ $message->user->name }} dijo:</p>
                                <p class="break-words whitespace-normal">
                                    {{ $message->body }}
                                </p>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-gray-500 dark:text-gray-400 mb-6">Aún no hay comentarios.</p>
                @endforelse

                @if ($totalComments > 4)
                    <div class="mt-4 flex justify-center gap-4">
                        <!-- Botón "Ver más" -->
                        <button x-show="!showAll" @click="showAll = true"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                            Ver más
                        </button>

                        <!-- Botón "Ver menos" -->
                        <button x-show="showAll" @click="showAll = false"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                            Ver menos
                        </button>
                    </div>
                @endif
            </div>

            <!-- Formulario para comentar -->
            <div class="mt-10">
                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Añade un comentario</h3>

                @auth
                    <form method="POST" action="{{ route('services.comentar', $service->id) }}" class="space-y-4">
                        @csrf

                        <textarea name="body" rows="3"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200"
                            placeholder="Escribe tu comentario aquí...">{{ old('body') }}</textarea>

                        @error('body')
                            <p class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                            Publicar
                        </button>
                    </form>
                @else
                    <p class="text-gray-500 dark:text-gray-400">
                        Debes
                        <a href="{{ route('login') }}" class="text-blue-500 dark:text-blue-400 underline">
                            iniciar sesión
                        </a> para comentar.
                    </p>
                @endauth
            </div>

            <!-- CTA final: rellena el hueco y aporta un cierre vistoso -->
            <div class="mt-8 py-6 bg-blue-600 rounded-lg text-center text-white">
                <h2 class="text-xl font-semibold">¿Te gustaría ir a este sitio?</h2>
                <p class="mt-2">¡Reserva ahora y deja todo en nuestras manos!</p>
                <!-- Botón para volver a ver todos los viajes -->
                <a href="{{ route('services.index') }}"
                    class="inline-block mt-4 ml-3 px-6 py-2 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition">
                    Ver otros viajes
                </a>
                <a href="#"
                    class="inline-block mt-4 px-6 py-2 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition">
                    ¡Vámonos a este sitio!
                </a>
            </div>
        </div>
    </div>
@endsection
