@foreach ($messages as $message)
    <div class="mb-4">
        <strong>{{ $message->user->name }}:</strong> {{ $message->body }}

        @foreach ($message->attachments as $file)
            @if ($file->type === 'image')
                <div><img src="{{ asset('storage/' . $file->path) }}" alt="Imagen" class="w-40 mt-2"></div>
            @elseif ($file->type === 'audio')
                <div><audio controls src="{{ asset('storage/' . $file->path) }}"></audio></div>
            @endif
        @endforeach
    </div>
@endforeach
