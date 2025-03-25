<x-app-layout>
    <div class="flex min-h-screen">

        {{-- Contenido principal con imagen de fondo --}}
        <div
            class="flex-1 relative bg-cover bg-center"
            style="background-image: url('{{ asset('images/montanias.jpg') }}');"
        >
            <!-- Overlay para oscurecer la imagen -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <!-- Contenedor interno con scroll vertical -->
            <div class="relative z-10 max-w-4xl mx-auto h-screen overflow-y-auto px-4 py-6">

                <h1 class="text-3xl font-bold mb-4 text-white">
                    ¿Te gusta viajar? ¡Tenemos variedad!
                </h1>

                {{-- 1. Define un array con los nombres de tus imágenes --}}
                @php
                    $images = [
                        'paris.jpg',
                        'china.jpg',
                        'serengeti.jpg',
                        'toscana.jpg',
                        'machupicchu.jpg',
                    ];
                @endphp

                <ul class="space-y-6">
                    @foreach($services as $service)
                        {{-- 2. Escoge una imagen aleatoria para cada servicio --}}
                        @php
                            $randomImage = $images[array_rand($images)];
                        @endphp

                        <li class="relative rounded-lg shadow overflow-hidden text-white">
                            {{-- 3. Div de fondo con la imagen aleatoria --}}
                            <div class="absolute inset-0 bg-cover bg-center"
                                 style="background-image: url('{{ asset('images/' . $randomImage) }}');">
                            </div>

                            {{-- Overlay semitransparente para que se lea el texto --}}
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                            {{-- Contenido en capa superior --}}
                            <div class="relative z-10 p-4">
                                <h2 class="text-xl font-bold">
                                    {{ $service->title }}
                                </h2>
                                <p>
                                    {{ $service->description }}
                                </p>
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
