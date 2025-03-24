<?php
use Livewire\WithFileUploads;
use App\Models\Attachment;
use App\Models\Message;
use Livewire\Component;

class MessageForm extends Component
{
    use WithFileUploads;

    public $conversationId;
    public $body;
    public $file;

    public function sendMessage()
    {
        $this->validate([
            'body' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // 10MB
        ]);

        if (!$this->body && !$this->file) {
            return;
        }

        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'user_id' => auth()->id(),
            'body' => $this->body,
        ]);

        // Si hay archivo, lo subimos
        if ($this->file) {
            $path = $this->file->store('attachments', 'public');
            $mime = $this->file->getMimeType();

            Attachment::create([
                'message_id' => $message->id,
                'path' => $path,
                'type' => $this->getFileType($mime),
            ]);
        }

        $this->emitUp('messageSent');
        $this->reset(['body', 'file']);
    }

    private function getFileType($mime)
    {
        if (str_contains($mime, 'image')) return 'image';
        if (str_contains($mime, 'audio')) return 'audio';
        return 'file';
    }
}
