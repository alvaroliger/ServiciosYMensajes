<?php

namespace app\Http\Livewire\Chat;

use Livewire\Component;

class Messages extends Component
{
    public $serviceId;

    public function mount($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function render()
    {
        // Asegúrate de que este archivo existe: resources/views/livewire/chat/messages.blade.php
        return view('livewire.chat.messages');
    }
}
