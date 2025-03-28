@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{ __('¡Uy! Algo salió mal.
            Estas credenciales no coinciden con nuestros registros.') }}</div>
    </div>
@endif
