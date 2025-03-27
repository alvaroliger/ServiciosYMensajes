@extends('layouts.paraExtends')

@section('content')
<div class="min-h-screen bg-gray-100 transition-colors duration-300">
    <div class="max-w-4xl mx-auto mt-12 mb-12 bg-white shadow-2xl rounded-2xl p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-2">
                {{ $service->title }}
            </h1>
            <p class="text-gray-600">Descubre un destino inolvidable con nosotros.</p>
        </div>

        <!-- Carrusel -->
        <div x-data="{ current: 1 }" class="max-w-3xl mx-auto mb-10 space-y-4">
            <div class="w-full h-64 bg-gray-200 rounded-md overflow-hidden">
                <img x-show="current === 1" src="/images/paris/paris1.jpg" class="w-full h-full object-cover" />
                <img x-show="current === 2" src="/images/paris/paris2.jpg" class="w-full h-full object-cover" />
                <img x-show="current === 3" src="/images/paris/paris3.jpg" class="w-full h-full object-cover" />
                <img x-show="current === 4" src="/images/paris/paris4.jpg" class="w-full h-full object-cover" />
                <img x-show="current === 5" src="/images/paris/paris5.jpg" class="w-full h-full object-cover" />
            </div>

            <div class="flex justify-between">
                <button @click="current = (current === 1) ? 5 : (current - 1)"
                    class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded-md transition">
                    Anterior
                </button>
                <button @click="current = (current === 5) ? 1 : (current + 1)"
                    class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded-md transition">
                    Siguiente
                </button>
            </div>

            <div class="flex justify-center gap-2">
                <template x-for="i in 5" :key="i">
                    <div @click="current = i" :class="current === i ? 'bg-blue-600' : 'bg-gray-300'"
                        class="w-3 h-3 rounded-full border border-gray-400 cursor-pointer"></div>
                </template>
            </div>
        </div>

        <!-- Detalles -->
        <div class="space-y-3 text-gray-700 text-base sm:text-lg mb-12">
            <p><span class="font-semibold">Descripción:</span> {{ $service->description }}</p>
            <p><span class="font-semibold">Precio:</span> {{ $service->price }} €</p>
            <p><span class="font-semibold">Duración:</span> {{ $service->duration }} noches</p>
            <p><span class="font-semibold">Estado:</span>
                @if ($service->status === 'activo')
                    <span class="text-green-600 font-semibold">Activo</span>
                @else
                    <span class="text-red-600 font-semibold">Inactivo</span>
                @endif
            </p>
        </div>

        <!-- Comentarios -->
        <div x-data="{ showAll: false }">
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Comentarios</h2>

            @php
                $totalComments = $service->messages->count();
            @endphp

            @forelse($service->messages as $index => $message)
                @if(auth()->check() && auth()->user()->id === $message->user->id)
                    <!-- Mensaje enviado por el usuario (alineado a la derecha) -->
                    <div x-show="showAll || {{ $index }} < 4" class="mb-6 flex justify-end">
                        <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow-sm transition max-w-xs">
                            <p class="text-sm mb-1 text-right">Tú</p>
                            <p class="text-right">{{ $message->body }}</p>
                        </div>
                    </div>
                @else
                    <!-- Mensaje de otros usuarios (alineado a la izquierda) -->
                    <div x-show="showAll || {{ $index }} < 4" class="mb-6 flex justify-start">
                        <div class="p-4 bg-gray-50 text-gray-800 border border-gray-200 rounded-lg shadow-sm transition max-w-xs">
                            <p class="text-sm mb-1">{{ $message->user->name }} dijo:</p>
                            <p>{{ $message->body }}</p>
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-gray-500 mb-6">Aún no hay comentarios.</p>
            @endforelse

            @if ($totalComments > 4)
                <div class="mt-4 flex justify-center gap-4">
                    <!-- Botón "Ver más" -->
                    <button x-show="!showAll" @click="showAll = true"
                        class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded-md transition">
                        Ver más
                    </button>

                    <!-- Botón "Ver menos" -->
                    <button x-show="showAll" @click="showAll = false"
                        class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded-md transition">
                        Ver menos
                    </button>
                </div>
            @endif
        </div>

        <!-- Formulario para comentar -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold mb-2 text-gray-800">Añade un comentario</h3>

            @auth
                <form method="POST" action="{{ route('services.comentar', $service->id) }}" class="space-y-4">
                    @csrf

                    <textarea name="body" rows="3"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="Escribe tu comentario aquí...">{{ old('body') }}</textarea>

                    @error('body')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-black px-5 py-2 rounded-lg shadow transition">
                        Publicar
                    </button>
                </form>
            @else
                <p class="text-gray-500">
                    Debes
                    <a href="{{ route('login') }}" class="text-blue-500 underline">
                        iniciar sesión
                    </a> para comentar.
                </p>
            @endauth
        </div>
    </div>
</div>
@endsection
