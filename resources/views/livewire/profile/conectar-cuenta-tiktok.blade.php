<div class="p-6 sm:p-8 bg-white shadow sm:rounded-lg mt-6">
    <div class="max-w-xl">
        <h2 class="text-lg font-medium text-gray-900">
            Cuenta TikTok
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Vincula tu cuenta de TikTok para compartir tus experiencias desde ViajARTE.
        </p>

        <div class="mt-4">
            @if (auth()->user()->tiktok_id)
                <div class="text-sm text-green-600">
                    Cuenta vinculada como: <strong>{{ auth()->user()->tiktok_username ?? 'sin nombre' }}</strong>
                </div>
            @else
                <a href="{{ route('tiktok.redirigir') }}"
                   class="inline-block mt-2 px-5 py-2 bg-[#F53003] text-white rounded hover:bg-red-600 transition">
                    Vincular cuenta TikTok
                </a>
            @endif
        </div>
    </div>
</div>
