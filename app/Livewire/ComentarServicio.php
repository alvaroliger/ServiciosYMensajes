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
            'body' => 'required|string|max:500',
        ]);

        // Guarda el mensaje con el service_id
        $message = Message::create([
            'body' => $this->body,
            'user_id' => auth()->id(),
            'service_id' => $this->serviceId, // Asocia el mensaje al servicio actual
        ]);

        // Limpia el campo de texto
        $this->body = '';

        // Emite un evento para actualizar la lista de mensajes
        $this->emit('messageAdded', $message->id);

        // Opcional: desplázate al final de la página
        $this->dispatchBrowserEvent('scrollToBottom');
    }
    public $serviceId;

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
