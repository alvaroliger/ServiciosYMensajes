<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ConectarCuentaTiktok extends Component
{
    public function render()
    {
        return view('livewire.profile.conectar-cuenta-tiktok', [
            'tiktok_id' => Auth::user()->tiktok_id,
            'tiktok_username' => Auth::user()->tiktok_username,
        ]);
    }
}
