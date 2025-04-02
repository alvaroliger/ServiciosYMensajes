@extends('layouts.paraLvSinConflictos')

@section('content')
    <div>
        <div>
            <h1>{{ $service->title }}</h1>
            <p>Descubre un destino inolvidable con nosotros.</p>
        </div>

        <!-- Carrusel simple sin JS ni estilos -->
        <div>
            @if ($fotos && count($fotos) > 0)
                <div>
                    @foreach ($fotos as $index => $foto)
                        <div>
                            <img src="{{ asset($foto) }}" alt="Foto del servicio">
                        </div>
                    @endforeach
                </div>
            @else
                <p>No hay imágenes disponibles para este servicio.</p>
            @endif
        </div>

        <!-- Detalles del servicio -->
        <div>
            <p><strong>Descripción:</strong> {{ $service->description }}</p>
            <p><strong>Precio:</strong> {{ $service->price }} €</p>
            <p><strong>Duración:</strong> {{ $service->duration }} noches</p>
            <p><strong>Estado:</strong>
                @if ($service->status === 'activo')
                    Activo
                @else
                    Inactivo
                @endif
            </p>
        </div>

        <!-- Componente Livewire -->
        <livewire:comentar-servicio-sin-conflicto :service-id="$service->id" />

        <!-- Llamada a la acción -->
        <div>
            <h2>¿Te gustaría ir a este sitio?</h2>
            <p>¡Reserva ahora y deja todo en nuestras manos!</p>
            <a href="#">¡Vámonos!</a>
            <a href="{{ route('services.index') }}">Ver todos los viajes</a>
        </div>
    </div>
@endsection
