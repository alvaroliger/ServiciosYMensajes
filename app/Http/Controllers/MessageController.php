<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'service_id' => 'required|exists:services,id',
        ]);

        \App\Models\Message::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'body' => $request->body,
        ]);

        return redirect($request->input('redirect_to', '/'))->with('success', 'Comentario publicado con éxito.');
    }

    public function getMessages(Conversation $conversation)
    {
        $messages = $conversation->messages()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return response()->json($messages);
    }
}
