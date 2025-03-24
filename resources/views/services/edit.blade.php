{{-- resources/views/services/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Servicio</h1>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required>
            </div>

            <div>
                <label for="description">Descripción:</label>
                <textarea name="description" id="description">{{ old('description', $service->description) }}</textarea>
            </div>

            <div>
                <label for="price">Precio:</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $service->price) }}">
            </div>

            <button type="submit">Actualizar</button>
        </form>
    </div>
@endsection
