<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuestros Servicios') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Lista de Servicios</h1>
        <ul>
            @foreach($services as $service)
            <div class="border p-4 rounded-lg shadow">
                <h2 class="text-xl font-bold">{{ $service->title }}</h2>
                <p>{{ $service->description }}</p>

                <a href="{{ route('services.show', $service->id) }}"
                   class="inline-block mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                   Ver detalles
                </a>
            </div>
        @endforeach

        </ul>
    </div>
</x-app-layout>
