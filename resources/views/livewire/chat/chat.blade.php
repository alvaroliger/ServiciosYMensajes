@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-8 space-y-4">
    <h2 class="text-2xl font-semibold">Chat</h2>

    {{-- Sección de mensajes --}}
    <livewire:chat.messages :conversationId="$conversation->id" />

    <hr>

    {{-- Sección del formulario para enviar mensajes --}}
    <livewire:chat.message-form :conversationId="$conversation->id" />
</div>
@endsection
