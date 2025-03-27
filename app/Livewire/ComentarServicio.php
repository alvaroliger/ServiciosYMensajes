<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ComentarServicio extends Component
{
    public $serviceId;
    public $body;

    protected $rules = [
        'body' => 'required|min:3',
    ];

    public function comentar()
    {
        $this->validate();

        Message::create([
            'body' => $this->body,
            'user_id' => Auth::id(),
            'service_id' => $this->serviceId,
        ]);

        $this->reset('body');
        $this->dispatchBrowserEvent('comentario-publicado');
    }

    public function render()
    {
        return view('livewire.comentar-servicio');
    }
}
