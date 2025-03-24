<div>
    <h2>Mis conversaciones</h2>
    @foreach ($conversations as $conv)
        <div>
            <a href="{{ route('chat', ['id' => $conv->id]) }}">
                Servicio: {{ $conv->service->title }}
            </a>
        </div>
    @endforeach
</div>
