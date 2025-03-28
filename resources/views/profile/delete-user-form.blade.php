<!-- Fondo semitransparente sobre imagen de fondo -->
<div class="p-6 bg-white/70 rounded shadow-md">

    <x-action-section>
        <x-slot name="title">
            <span class="text-black">Eliminar cuenta</span>
        </x-slot>

        <x-slot name="description">
            <span class="text-black">Elimina tu cuenta de forma permanente.</span>
        </x-slot>

        <x-slot name="content">
            <div class="max-w-xl text-sm text-gray-700">
                Una vez que elimines tu cuenta, todos sus datos y recursos serán eliminados de forma permanente. Antes de continuar, asegúrate de descargar cualquier dato o información que desees conservar.
            </div>

            <div class="mt-5">
                <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                    Eliminar cuenta
                </x-danger-button>
            </div>

            <!-- Modal de confirmación para eliminar cuenta -->
            <x-dialog-modal wire:model.live="confirmingUserDeletion">
                <x-slot name="title">
                    Eliminar cuenta
                </x-slot>

                <x-slot name="content">
                    ¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer. Una vez eliminada, todos los recursos y datos asociados se perderán de forma permanente.

                    Por favor, introduce tu contraseña para confirmar que deseas eliminar tu cuenta definitivamente.

                    <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                        <x-input type="password" class="mt-1 block w-3/4"
                                 autocomplete="current-password"
                                 placeholder="Contraseña"
                                 x-ref="password"
                                 wire:model="password"
                                 wire:keydown.enter="deleteUser" />

                        <x-input-error for="password" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                        Cancelar
                    </x-secondary-button>

                    <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                        Eliminar cuenta
                    </x-danger-button>
                </x-slot>
            </x-dialog-modal>
        </x-slot>
    </x-action-section>

</div>
