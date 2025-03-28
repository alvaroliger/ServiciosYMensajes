<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\Service;
use App\Models\User;

class Messages extends Component
{
    public $serviceId;

    public function mount($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function render()
    {
        return view('livewire.chat.messages');
    }
}
