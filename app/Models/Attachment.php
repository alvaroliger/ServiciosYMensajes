<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class Attachment extends Model
{
    /** @use HasFactory<\Database\Factories\AttachmentFactory> */
    use HasFactory;

    // Método para guardar archivos adjuntos
    public function storeAttachment(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id',
            'file' => 'required|file|max:10240',
        ]);
        $path = $request->file('file')->store('attachments', 'public');
        $type = $this->getFileType($request->file('file')->getMimeType());
        $attachment = Attachment::create([
            'message_id' => $request->message_id,
            'path' => $path,
            'type' => $type,
        ]);
        return response()->json($attachment, 201);
    }
    private function getFileType($mimeType)
    {
        if (strpos($mimeType, 'image') !== false) {
            return 'image';
        } elseif (strpos($mimeType, 'audio') !== false) {

            return 'audio';
        }
        return 'file';
    }
}
