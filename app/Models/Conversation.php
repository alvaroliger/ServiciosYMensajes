<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /** @use HasFactory<\Database\Factories\ConversationFactory> */
    use HasFactory;

    // Modelo Conversation
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function participants()
    {
        return $this->belongsToMany(User::class, 'conversation');
    }

    
}
