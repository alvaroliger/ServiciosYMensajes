<!-- Fondo semitransparente sobre imagen de fondo -->
<div class="p-6 bg-white/70 rounded shadow-md">

    <x-form-section submit="updateProfileInformation">
        <x-slot name="title">
            <span class="text-white">Información del perfil</span>
        </x-slot>

        <x-slot name="description">
            <span class="text-white">Actualiza la información de tu perfil y tu dirección de correo electrónico.</span>
        </x-slot>

        <x-slot name="form">
            <!-- Foto de Perfil (si Jetstream la gestiona) -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                    <!-- Input de Foto de Perfil -->
                    <input
                        type="file"
                        id="photo"
                        class="hidden"
                        wire:model.live="photo"
                        x-ref="photo"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        "
                    />

                    <x-label for="photo" value="Foto de Perfil" />

                    <!-- Foto de Perfil Actual -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img
                            src="{{ $this->user->profile_photo_url }}"
                            alt="{{ $this->user->name }}"
                            class="rounded-full size-20 object-cover"
                        >
                    </div>

                    <!-- Vista Previa de la Nueva Foto -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span
                            class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                        >
                        </span>
                    </div>

                    <x-secondary-button
                        class="mt-2 me-2"
                        type="button"
                        x-on:click.prevent="$refs.photo.click()"
                    >
                        Seleccionar una nueva foto
                    </x-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-secondary-button
                            type="button"
                            class="mt-2"
                            wire:click="deleteProfilePhoto"
                        >
                            Eliminar foto
                        </x-secondary-button>
                    @endif

                    <x-input-error for="photo" class="mt-2" />
                </div>
            @endif

            <!-- Nombre -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="Nombre" />
                <x-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    wire:model.defer="state.name"
                    required
                    autocomplete="name"
                />
                <x-input-error for="name" class="mt-2" />
            </div>

            <!-- Correo Electrónico -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="email" value="Correo Electrónico" />
                <x-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    wire:model.defer="state.email"
                    required
                    autocomplete="username"
                />
                <x-input-error for="email" class="mt-2" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2">
                        Tu dirección de correo electrónico no ha sido verificada.

                        <button
                            type="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            wire:click.prevent="sendEmailVerification"
                        >
                            Haz clic aquí para reenviar el correo de verificación.
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.
                        </p>
                    @endif
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                Guardado.
            </x-action-message>

            <!-- Botón principal para guardar -->
            <x-button wire:loading.attr="disabled" wire:target="photo">
                Guardar
            </x-button>
        </x-slot>
    </x-form-section>
</div>
