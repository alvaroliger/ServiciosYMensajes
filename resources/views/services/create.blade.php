{{-- resources/views/services/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Servicio</h1>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="description">Descripción:</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="price">Precio:</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}">
            </div>

            <button type="submit">Guardar</button>
        </form>
    </div>
@endsection
