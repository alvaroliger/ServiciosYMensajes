<?php

namespace App\Http\Livewire\Chat;

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
        return view('livewire.chat.messages');
    }
}
