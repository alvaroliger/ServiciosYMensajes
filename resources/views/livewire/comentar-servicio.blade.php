<div>
    <div x-data="{ showAll: false }" wire:poll.500ms>
        <h2 class="text-2xl font-bold text-blue-900 dark:text-blue-200 mb-4">Comentarios</h2>

        @forelse($messages as $index => $message)
            <div wire:key="mensaje-{{ $message->id }}" @if ($loop->last) data-nuevo-comentario @endif>
                @php

                    $isOwn = auth()->check() && auth()->user()->id === $message->user->id;

                    $recuento = \App\Models\Reaction::select('type', DB::raw('count(*) as total'))
                        ->where('message_id', $message->id)
                        ->groupBy('type')
                        ->pluck('total', 'type');
                @endphp

                <div x-show="showAll || {{ $index }} < 4"
                    class="mb-6 flex {{ $isOwn ? 'justify-end' : 'justify-start' }} animate__animated animate__fadeInUp animate__faster">
                    <div
                        class="p-4 {{ $isOwn ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100' : 'bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600' }}
                            rounded-lg shadow-sm transition max-w-xs break-words whitespace-normal">

                        <p class="text-sm mb-1 {{ $isOwn ? 'text-right' : '' }}">
                            {{ $isOwn ? 'Tú' : $message->user->name . ' dijo:' }}
                        </p>

                        <p class="{{ $isOwn ? 'text-right' : '' }}">{{ $message->body }}</p>

                        {{-- Mostrar recuento de reacciones --}}
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400 {{ $isOwn ? 'text-right' : '' }}">
                            @foreach (['❤️', '😂', '👍'] as $emoji)
                                <span class="inline-block mr-2">
                                    {{ $emoji }} {{ $recuento[$emoji] ?? 0 }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Reacciones solo para mensajes de otros usuarios --}}
                        @unless ($isOwn)
                            <div class="relative group mt-2">
                                <button
                                    class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-blue-500 transition"
                                    x-data>
                                    Reaccionar
                                </button>

                                <div class="absolute z-10 mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md p-2 flex gap-2 opacity-0 group-hover:opacity-100 transition duration-200"
                                    style="top: 100%; left: 0;">
                                    @foreach (['❤️', '😂', '👍'] as $emoji)
                                        <button
                                            wire:click="$emit('reaccionarMensaje', {{ $message->id }}, '{{ $emoji }}')"
                                            x-data
                                            @click="$el.classList.add('animate__animated', 'animate__tada'); setTimeout(() => $el.classList.remove('animate__animated', 'animate__tada'), 1000)"
                                            class="text-xl hover:scale-125 transition transform">
                                            {{ $emoji }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endunless
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400 mb-6">Aún no hay comentarios.</p>
        @endforelse

        @if ($messages->count() > 4)
            <div class="mt-4 flex justify-center gap-4">
                <button x-show="!showAll"
                    @click="showAll = true; $el.classList.add('animate__animated','animate__fadeInDown'); setTimeout(() => $el.classList.remove('animate__animated','animate__fadeInDown'), 1000)"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    Ver más
                </button>

                <button x-show="showAll"
                    @click="showAll = false; $el.classList.add('animate__animated','animate__fadeOutUp'); setTimeout(() => $el.classList.remove('animate__animated','animate__fadeOutUp'), 1000)"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    Ver menos
                </button>
            </div>
        @endif
    </div>

    <div class="mt-10">
        <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Añade un comentario</h3>
        <!-- Formulario para agregar un nuevo comentario -->
        @auth
            <form wire:click="submit" class="space-y-4">
                <div>
                    <textarea wire:model.defer="body" id="body" rows="3"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                        placeholder="Escribe tu comentario aquí..."></textarea>
                    @error('body')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md shadow-md animate__animated animate__heartBeat animate__delay-1s animate__repeat-1">
                        Publicar
                    </button>
                </div>
            </form>
        @else
            <p class="text-gray-600 dark:text-gray-300">
                Debes <a href="{{ route('login') }}" class="text-blue-600 underline">iniciar sesión</a> para comentar.
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
                    lastComment.classList.add('animate__animated', 'animate__bounceIn');
                }
            });
        </script>
    @endpush
</div>
