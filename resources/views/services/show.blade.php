@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8 bg-white rounded shadow mt-8 space-y-6">

    <h1 class="text-3xl font-bold text-gray-800">
        {{ $service->title }}
    </h1>

    {{-- Imagen del servicio
    @if ($service->image_path)
        <img
            src="{{ asset('storage/' . $service->image_path) }}"
            alt="Imagen del servicio"
            class="w-full h-auto rounded shadow-sm"
        >
    @endif
--}}
    {{-- Descripción y datos del servicio --}}
    <div class="space-y-1">
        <p class="text-lg text-gray-700">
            {{ $service->description }}
        </p>
        <p class="text-sm text-gray-600">
            <strong>Duración:</strong> {{ $service->duration }} días
        </p>
        <p class="text-sm text-gray-600">
            <strong>Precio:</strong> {{ $service->price }}€
        </p>
    </div>

    <hr class="border-gray-200">

    {{-- Mensajes --}}
    <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">
            Mensajes
        </h2>
        @livewire('chat.messages', ['serviceId' => $service->id])
    </div>

</div>
@endsection
