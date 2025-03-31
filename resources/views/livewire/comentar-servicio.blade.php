<div>
    <div x-data="{ showAll: false }" wire:poll.500ms>
        <h2 class="text-2xl font-bold text-blue-900 dark:text-blue-200 mb-4">Comentarios</h2>
        <p class="text-sm text-green-500">Livewire funciona</p>

        @forelse($messages as $index => $message)
            <div wire:key="mensaje-{{ $message->id }}">
                @if (auth()->check() && auth()->user()->id === $message->user->id)
                    <div x-show="showAll || {{ $index }} < 4" class="mb-6 flex justify-end">
                        <div
                            class="p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 rounded-lg shadow-sm transition max-w-xs break-words whitespace-normal">
                            <p class="text-sm mb-1 text-right">Tú</p>
                            <p class="text-right">{{ $message->body }}</p>
                        </div>
                    </div>
                @else
                    <div x-show="showAll || {{ $index }} < 4" class="mb-6 flex justify-start">
                        <div
                            class="p-4 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm transition max-w-xs break-words whitespace-normal">
                            <p class="text-sm mb-1">{{ $message->user->name }} dijo:</p>
                            <p>{{ $message->body }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-gray-500 dark:text-gray-400 mb-6">Aún no hay comentarios.</p>
        @endforelse

        @if ($messages->count() > 4)
            <div class="mt-4 flex justify-center gap-4">
                <button x-show="!showAll" @click="showAll = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    Ver más
                </button>
                <button x-show="showAll" @click="showAll = false"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                    Ver menos
                </button>
            </div>
        @endif
    </div>

    <div class="mt-10">
        <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Añade un comentario</h3>

        @auth
            <form wire:submit.prevent="submit" class="space-y-4">
                <textarea wire:model.defer="body" rows="3"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg p-3 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200"
                    placeholder="Escribe tu comentario aquí..."></textarea>

                @error('body')
                    <p class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                    Publicar
                </button>
            </form>
        @else
            <p class="text-gray-500 dark:text-gray-400">
                Debes
                <a href="{{ route('login') }}" class="text-blue-500 dark:text-blue-400 underline">
                    iniciar sesión
                </a> para comentar.
            </p>
        @endauth
    </div>

    <script>
        Livewire.on('scrollToBottom', () => {
            setTimeout(() => {
                window.scrollTo({
                    top: document.body.scrollHeight,
                    behavior: 'smooth'
                });
            }, 100);
        });
    </script>
</div>
