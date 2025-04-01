<x-app-layout>
    <div class="flex min-h-screen">
        {{-- Contenedor principal a pantalla completa con scroll vertical --}}
        <div class="flex-1 relative h-screen overflow-y-auto bg-cover bg-no-repeat"
            style="background-image: url('{{ asset('images/fondo/montanias.jpg') }}');">
            <!-- Contenedor interno sin scroll para centrar contenido -->
            <div class="relative z-10 max-w-4xl mx-auto px-4 py-6">
                <h1 class="text-3xl font-bold mb-4 text-white">
                    ¿Te gusta viajar? ¡Tenemos variedad!
                </h1>

                <ul class="space-y-6">
                    @foreach ($services as $service)
                        @php
                            $serviceImages = $images[$service->id] ?? [];
                        @endphp

                        <li class="relative rounded-lg shadow overflow-hidden text-white">
                            <div class="absolute inset-0 bg-cover bg-center"
                                style="background-image: url('{{ asset($serviceImages[0] ?? 'images/default.jpg') }}');">
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                            <div class="relative z-10 p-4">
                                <h2 class="text-xl font-bold">
                                    {{ $service->title }}
                                </h2>
                                <p>{{ $service->description }}</p>
                                <a href="{{ route('services.show', $service->id) }}"
                                    class="inline-block mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                    Ver detalles
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
