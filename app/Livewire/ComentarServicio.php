<?php

namespace App\Livewire;

use AllowDynamicProperties;
use Livewire\Component;
use App\Models\Service;
use App\Models\Message;

class ComentarServicio extends Component
{
    public string $body = '';
    public function submit()
    {
        $this->validate([
            'body' => 'required|min:2|max:500',
        ]);

        Message::create([
            'user_id' => auth()->id(),
            'service_id' => $this->serviceId,
            'body' => $this->body,
        ]);

        $this->reset('body');

        $this->emit('scrollToBottom');
        $this->emit('comentarioAgregado');
    }


    public function mount($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function render()
    {
        return view('livewire.comentar-servicio', [
            'messages' => Message::where('service_id', $this->serviceId)
                                 ->latest()
                                 ->get(),
        ]);
    }
}
