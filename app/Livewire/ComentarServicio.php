<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ComentarServicio extends Component
{
    public Service $service;
    public string $body = '';

    public function submit()
    {
        $this->validate([
            'body' => 'required|string|max:1000',
        ]);

        $this->service->messages()->create([
            'user_id' => auth()->id(),
            'service_id' => $this->service->id,
            'body' => $this->body,
        ]);

        $this->body = '';

        $this->service->refresh();
    }

    public function render()
    {
        return view('livewire.comentar-servicio', [
            'messages' => $this->service->messages()->latest()->get(),
        ]);
    }
}
