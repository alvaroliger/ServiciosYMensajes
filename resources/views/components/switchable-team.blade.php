@props(['team', 'component' => 'dropdown-link'])

<form method="POST" action="{{ route('current-team.update') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="team_id" value="{{ $team->id }}">

    <x-dynamic-component :component="$component" href="#" x-on:click.prevent="$root.submit();">
        <div class="flex items-center">
            @if (Auth::user()->isCurrentTeam($team))
            <img src="{{ asset('images/logo/logo.png') }}" alt="ViaJARTE Logo" class="w-full h-auto transition-all translate-y-0 opacity-100 max-w-none duration-750 starting:opacity-0 starting:translate-y-6">
            @endif

            <div class="truncate">{{ $team->name }}</div>
        </div>
    </x-dynamic-component>
</form>
