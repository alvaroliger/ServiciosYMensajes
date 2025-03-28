@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-xl">

    <h1 class="text-3xl font-bold mb-2">{{ $service->title }}</h1>
    <p class="text-gray-600 mb-4">{{ $service->category->name ?? 'Sin categoría' }}</p>
    <p class="mb-4">{{ $service->description }}</p>
    <p class="text-xl font-semibold text-green-600 mb-4">Precio: {{ $service->price }} €</p>

    <livewire:comentar-servicio :service="$service" />

</div>
@endsection
