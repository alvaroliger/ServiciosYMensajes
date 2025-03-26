@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-xl">

    <h1 class="text-3xl font-bold mb-2">{{ $service->title }}</h1>
    <p class="text-gray-600 mb-4">{{ $service->category->name ?? 'Sin categoría' }}</p>
    <p class="mb-4">{{ $service->description }}</p>
    <p class="text-xl font-semibold text-green-600 mb-4">Precio: {{ $service->price }} €</p>

    <!-- Galería de imágenes -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
        @foreach($service->images as $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" class="rounded-lg shadow" alt="Imagen del viaje">
        @endforeach
    </div>

    <!-- Foro de comentarios -->
    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4">Comentarios</h2>
        @foreach($service->messages as $message)
            <div class="mb-3 border-b pb-2">
                <p class="text-sm text-gray-500">{{ $message->user->name }} dijo:</p>
                <p>{{ $message->content }}</p>
            </div>
        @endforeach
    </div>

</div>
@endsection
