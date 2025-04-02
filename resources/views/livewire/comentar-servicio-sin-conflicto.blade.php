<div>
    <div wire:poll.500ms>
        <h2>Comentarios</h2>

        @forelse($messages as $index => $message)
            <div wire:key="mensaje-{{ $message->id }}" @if ($loop->last) data-nuevo-comentario @endif>
                @php
                    $isOwn = auth()->check() && auth()->user()->id === $message->user->id;

                    $recuento = \App\Models\Reaction::select('type', DB::raw('count(*) as total'))
                        ->where('message_id', $message->id)
                        ->groupBy('type')
                        ->pluck('total', 'type');
                @endphp

                <div>
                    <div>
                        <p>{{ $isOwn ? 'Tú' : $message->user->name . ' dijo:' }}</p>
                        <p>{{ $message->body }}</p>

                        <div>
                            @foreach (['❤️', '😂', '👍'] as $emoji)
                                <span>{{ $emoji }} {{ $recuento[$emoji] ?? 0 }}</span>
                            @endforeach
                        </div>

                        @unless ($isOwn)
                            <div>
                                <span>Reaccionar:</span>
                                @foreach (['❤️', '😂', '👍'] as $emoji)
                                    <button wire:click="$emit('reaccionarMensaje', {{ $message->id }}, '{{ $emoji }}')">
                                        {{ $emoji }}
                                    </button>
                                @endforeach
                            </div>
                        @endunless
                    </div>
                </div>
            </div>
        @empty
            <p>No hay comentarios.</p>
        @endforelse

        @if ($messages->count() > 4)
            <div>
                <button wire:click="$set('showAll', true)">Ver más</button>
                <button wire:click="$set('showAll', false)">Ver menos</button>
            </div>
        @endif
    </div>

    <div>
        <h3>Añadir un comentario</h3>

        @auth
            <form wire:submit.prevent="submit">
                <div>
                    <textarea wire:model.defer="body" id="body" rows="3" placeholder="Escribe tu comentario..."></textarea>
                    @error('body')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit">Publicar</button>
                </div>
            </form>
        @else
            <p>
                Debes <a href="{{ route('login') }}">iniciar sesión</a> para comentar.
            </p>
        @endauth
    </div>

    @push('scripts')
        <script>
            Livewire.on('scrollToBottom', () => {
                setTimeout(() => {
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: 'smooth'
                    });
                }, 100);
            });

            Livewire.on('comentarioAgregado', () => {
                const lastComment = document.querySelector('[data-nuevo-comentario]');
                if (lastComment) {
                    // Aquí podrías añadir una animación simple con JavaScript si luego lo necesitas
                }
            });
        </script>
    @endpush
</div>
