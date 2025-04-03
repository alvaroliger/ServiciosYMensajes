<x-jet-section-title>
    <x-slot name="title">
        {{ __('Cuenta TikTok') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Vincula tu cuenta de TikTok para compartir experiencias.') }}
    </x-slot>
</x-jet-section-title>

<div class="mt-5">
    @if ($tiktok_id)
        <p class="text-green-600 text-sm">
                TikTok vinculado: {{ $tiktok_username ?? 'sin nombre' }}
        </p>
    @else
        <a href="{{ url('/user/profile/tiktok') }}"
           class="inline-block mt-2 px-5 py-2 bg-[#F53003] text-white rounded hover:bg-red-600 transition">
            Vincular cuenta TikTok
        </a>
    @endif
</div>
