@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $service->title }}</h2>
    <p>{{ $service->description }}</p>

    <hr>

    <h4>Foro del Servicio</h4>

    @extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $service->title }}</h1>
    <img src="{{ asset('storage/' . $service->image_path) }}" alt="Imagen del servicio" class="mb-4 w-full rounded">

    <p class="text-lg text-gray-700">{{ $service->description }}</p>
    <p class="mt-4 text-sm text-gray-500">Duración: {{ $service->duration }} días</p>
    <p class="text-sm text-gray-500">Precio: {{ $service->price }}€</p>

    <hr class="my-6">

    {{-- Aquí se podría conectar con el sistema de mensajería --}}
    <h2 class="text-xl font-semibold mb-2">Mensajes</h2>
    @livewire('messages', ['serviceId' => $service->id]) {{-- Si usas Livewire --}}
</div>
@endsection


    @foreach($messages as $message)
        <div class="mb-2 p-2 border">
            <strong>{{ $message->user->name }}</strong>
            <p>{{ $message->body }}</p>
        </div>
    @endforeach

    {{ $messages->links() }}

    @auth
    <form method="POST" action="{{ route('messages.store') }}">
        @csrf
        <input type="hidden" name="service_id" value="{{ $service->id }}">
        <textarea name="body" class="form-control my-2" rows="3" placeholder="Escribe tu mensaje..."></textarea>
        <button class="btn btn-primary">Enviar</button>
    </form>
    @endauth
</div>
@endsection
