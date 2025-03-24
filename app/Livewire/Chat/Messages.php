<?php
namespace App\Http\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use App\Models\Conversation;

class Messages extends Component
{
    public $conversationId;
    public $messages;
    public $page = 1;

    protected $listeners = ['messageSent' => 'loadMessages'];

    public function mount($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where('conversation_id', $this->conversationId)
        ->with('user', 'attachments')
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    }

    public function loadMore()
    {
        $this->page++;
        $moreMessages = Message::where('conversation_id', $this->conversationId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15, ['*'], 'page', $this->page);

        $this->messages = $this->messages->merge($moreMessages);
    }

    public function render()
    {
        return view('livewire.chat.messages');
    }
}
