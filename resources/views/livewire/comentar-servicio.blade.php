<div>
    <form wire:submit.prevent="comentar" class="space-y-4">
        <textarea wire:model.defer="body" rows="3"
            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200"
            placeholder="Escribe tu comentario aquí..."></textarea>

        @error('body')
            <p class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</p>
        @enderror

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
            Publicar
        </button>
    </form>

    <script>
        window.addEventListener('comentario-publicado', () => {
            alert("¡Comentario publicado con éxito!");
        });
    </script>
</div>
