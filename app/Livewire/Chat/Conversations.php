<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class Conversations extends Component
{
    public $conversations;

    public function mount($serviceId)
{
    $this->serviceId = $serviceId;

    // Aquí puedes cargar la conversación relacionada con ese servicio
    $this->conversation = Conversation::where('service_id', $serviceId)
                                      ->where(function ($q) {
                                          $q->where('user_id', auth()->id())
                                            ->orWhere('receiver_id', auth()->id());
                                      })->first();
}

    public function render()
    {
        return view('livewire.chat.conversations');
    }
}
