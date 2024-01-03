<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->query('user');
        $chat = $request->query('chat');
        $word = $request->query('word');

        if (! $user && ! $chat && ! $word) {
            return Message::all();
        }

        return Message::when($user, function ($query, $user) {
            return $query->where('user_id', $user);
        })->when($chat, function ($query, $chat) {
            return $query->where('chat_room_id', $chat);
        })->when($word, function ($query, $word) {
            return $query->where('message', 'like', '%'.$word.'%');
        })->get();
    }

    public function store(Request $request, $id)
    {
        $message = new Message;
        $message->message = $request->message;
        $message->user_id = auth()->user()->id;
        $message->chat_room_id = $id;
        $message->save();

        event(new MessageSent($message));
    }
}
