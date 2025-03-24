<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
        ]);

        $conversation = Conversation::firstOrCreate([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
        ]);

        return response()->json($conversation, 201);
    }
}
