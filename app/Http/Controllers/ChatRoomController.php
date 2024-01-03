<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use App\Models\UsersChatRooms;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatRoomController extends Controller
{
    public function index()
    {
        $ownChatRooms = ChatRoom::where('user_id', auth()->user()->id)->orWhere('is_public', true)->get();
        $usersChatRoom = UsersChatRooms::where('user_id', auth()->user()->id)->get();

        $chatRooms = collect();

        foreach ($ownChatRooms as $ownChatRoom) {
            $chatRooms->push($ownChatRoom);
        }

        foreach ($usersChatRoom as $userChatRoom) {
            $chatRooms->push(ChatRoom::find($userChatRoom->chat_room_id));
        }

        $chatRooms = $chatRooms->unique('id');

        return Inertia::render('ChatRooms/Index', [
            'chatRooms' => $chatRooms,
        ]);
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();

        return Inertia::render('ChatRooms/Create', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $chatroom = new ChatRoom;
        $chatroom->name = $request->name;
        $chatroom->description = $request->description;
        $chatroom->user_id = auth()->user()->id;
        $chatroom->is_public = $request->isPublic;
        $chatroom->save();

        $users = $request->users;
        foreach ($users as $user) {
            $usersChatRoom = new UsersChatRooms;
            $usersChatRoom->user_id = $user;
            $usersChatRoom->chat_room_id = $chatroom->id;
            $usersChatRoom->save();
        }

        return redirect()->route('chats.show', ['id' => $chatroom->id]);
    }

    public function show(string $id)
    {
        $chatroom = ChatRoom::find($id);
        $messages = Message::where('chat_room_id', $id)->get();

        $users = User::whereIn('id', $messages->pluck('user_id'))->get();

        return Inertia::render('ChatRooms/Show', [
            'chatroom' => $chatroom,
            'messages' => $messages,
            'users' => $users,
        ]);
    }
}
