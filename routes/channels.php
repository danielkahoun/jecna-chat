<?php

use App\Models\ChatRoom;
use App\Models\UsersChatRooms;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('Chatrooms.{id}', function ($user, $id) {
    $chatroom = Chatroom::find($request->route('id'));
    $usersChatRoom = UsersChatRooms::where(['chat_room_id' => $request->route('id'), 'user_id' => auth()->user()->id])->get();

    if ($chatroom->user_id == auth()->user()->id || $usersChatRoom->isNotEmpty()) {
        return true;
    } else {
        if ($chatroom->is_public) {
            return true;
        }
    }

    return false;
});
