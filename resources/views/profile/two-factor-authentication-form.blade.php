<!-- Fondo semitransparente sobre imagen de fondo -->
<div class="p-6 bg-white/70 rounded shadow-md">

    <x-action-section>
        <x-slot name="title">
            <span class="text-white">Autenticación en dos pasos</span>
        </x-slot>

        <x-slot name="description">
            <span class="text-white">Añade seguridad adicional a tu cuenta utilizando la autenticación en dos pasos.</span>
        </x-slot>

        <x-slot name="content">
            <h3 class="text-lg font-medium text-gray-900">
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        Finaliza la activación de la autenticación en dos pasos.
                    @else
                        Has activado la autenticación en dos pasos.
                    @endif
                @else
                    No has activado la autenticación en dos pasos.
                @endif
            </h3>
            
            <div class="mt-3 max-w-xl text-sm text-gray-700">
                <p>
                    Al activar la autenticación en dos pasos, se te pedirá un token seguro y aleatorio durante el inicio de sesión. Puedes obtener este token desde la app Google Authenticator de tu teléfono.
                </p>
            </div>

            @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="mt-4 max-w-xl text-sm text-gray-700">
                        <p class="font-semibold">
                            @if ($showingConfirmation)
                                Para finalizar la activación, escanea el siguiente código QR con tu app autenticadora o introduce la clave de configuración junto con el código OTP generado.
                            @else
                                La autenticación en dos pasos está ahora activa. Escanea el siguiente código QR o introduce la clave de configuración en tu app autenticadora.
                            @endif
                        </p>
                    </div>

                    <div class="mt-4 p-2 inline-block bg-white">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>

                    <div class="mt-4 max-w-xl text-sm text-gray-700">
                        <p class="font-semibold">
                            Clave de configuración: {{ decrypt($this->user->two_factor_secret) }}
                        </p>
                    </div>

                    @if ($showingConfirmation)
                        <div class="mt-4">
                            <x-label for="code" value="Código" />

                            <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                                wire:model="code"
                                wire:keydown.enter="confirmTwoFactorAuthentication" />

                            <x-input-error for="code" class="mt-2" />
                        </div>
                    @endif
                @endif

                @if ($showingRecoveryCodes)
                    <div class="mt-4 max-w-xl text-sm text-gray-700">
                        <p class="font-semibold">
                            Guarda estos códigos de recuperación en un gestor de contraseñas seguro. Puedes usarlos para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                @endif
            @endif

            <div class="mt-5">
                @if (! $this->enabled)
                    <x-confirms-password wire:then="enableTwoFactorAuthentication">
                        <x-button type="button" wire:loading.attr="disabled">
                            Activar
                        </x-button>
                    </x-confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-confirms-password wire:then="regenerateRecoveryCodes">
                            <x-secondary-button class="me-3">
                                Regenerar códigos de recuperación
                            </x-secondary-button>
                        </x-confirms-password>
                    @elseif ($showingConfirmation)
                        <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-button type="button" class="me-3" wire:loading.attr="disabled">
                                Confirmar
                            </x-button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="showRecoveryCodes">
                            <x-secondary-button class="me-3">
                                Mostrar códigos de recuperación
                            </x-secondary-button>
                        </x-confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-secondary-button wire:loading.attr="disabled">
                                Cancelar
                            </x-secondary-button>
                        </x-confirms-password>
                    @else
                        <x-confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-danger-button wire:loading.attr="disabled">
                                Desactivar
                            </x-danger-button>
                        </x-confirms-password>
                    @endif
                @endif
            </div>
        </x-slot>
    </x-action-section>

</div>
