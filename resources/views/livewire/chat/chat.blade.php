@extends('layouts.app')

@section('content')
    <livewire:chat.messages :conversationId="$conversation->id" />
    <livewire:chat.message-form :conversationId="$conversation->id" />
@endsection
