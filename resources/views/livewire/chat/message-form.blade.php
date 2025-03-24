<form wire:submit.prevent="sendMessage" enctype="multipart/form-data">
    <input type="text" wire:model.defer="body" placeholder="Escribe un mensaje..." />
    <input type="file" wire:model="file" accept="image/*,audio/*">
    <button type="submit">Enviar</button>
</form>

@error('file') <span class="text-red-500">{{ $message }}</span> @enderror
