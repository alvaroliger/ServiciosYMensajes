<?php

use Livewire\Component;
use App\Models\Message;
use App\Models\Reaction;
use Illuminate\Support\Facades\DB;

class ReaccionarMensaje extends Component
{
    public $message;

    public function mount(Message $message)
    {
        $this->message = $message;
    }

    public function reaccionar($emoji)
    {
        $user = auth()->user();

        $existe = Reaction::where('user_id', $user->id)
            ->where('message_id', $this->message->id)
            ->where('type', $emoji)
            ->first();

        if (!$existe) {
            Reaction::create([
                'user_id' => $user->id,
                'message_id' => $this->message->id,
                'type' => $emoji,
            ]);
        }

        $this->emitSelf('$refresh');
    }

    public function render()
    {
        $conteo = $this->message->reactions()
            ->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        return view('livewire.comentar-servicio', compact('contador'));
    }
}
