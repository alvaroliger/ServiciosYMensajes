<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow space-y-4">
    <h2 class="text-2xl font-semibold mb-4">Mis conversaciones</h2>

    @foreach ($conversations as $conv)
        <div class="border p-4 rounded hover:bg-gray-50">
            <a
                href="{{ route('chat', ['id' => $conv->id]) }}"
                class="text-blue-600 hover:text-blue-800 font-medium"
            >
                Servicio: {{ $conv->service->title }}
            </a>
        </div>
    @endforeach
</div>
