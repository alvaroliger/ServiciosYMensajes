<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\Reaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ComentarServicio extends Component
{

    #[Url]
    public int $serviceId;

    public string $body = '';

    public $messages = [];

    protected function loadMessages()
    {
        $this->messages = Message::with(['user', 'reactions'])
            ->where('service_id', $this->serviceId)
            ->orderBy('created_at', 'asc')
            ->get();
    }
    public function mount($serviceId)
    {
        $this->serviceId = $serviceId;
        $this->loadMessages();
    }

    public function render()
    {
        $this->messages = Message::with(['user', 'reactions'])
            ->where('service_id', $this->serviceId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.comentar-servicio');
    }

    public function submit()
    {
        \Log::info('Prueba de log diario ' . date('Y-m-d H:i:s'));
        $this->validate([
            'body' => 'required|string|min:1|max:500',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'service_id' => $this->serviceId,
            'body' => $this->body,
        ]);

        $this->body = '';
        $this->dispatch('scrollToBottom');
        $this->dispatch('comentarioAgregado');
        $this->loadMessages();
    }

    #[On('reaccionarMensaje')]
    public function agregarReaccion(int $mensajeId, string $emoji)
    {
        $usuario = Auth::user();

        if (!$usuario) return;

        $reaccionExistente = Reaction::where('user_id', $usuario->id)
            ->where('message_id', $mensajeId)
            ->where('emoji', $emoji)
            ->first();

        if ($reaccionExistente) {
            $reaccionExistente->delete();
        } else {
            Reaction::create([
                'user_id' => $usuario->id,
                'message_id' => $mensajeId,
                'emoji' => $emoji,
            ]);
        }
    }
}
