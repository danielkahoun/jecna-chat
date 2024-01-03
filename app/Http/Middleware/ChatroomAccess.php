<?php

namespace App\Http\Middleware;

use App\Models\Chatroom;
use App\Models\UsersChatRooms;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatroomAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $chatroom = Chatroom::find($request->route('id'));
        $usersChatRoom = UsersChatRooms::where(['chat_room_id' => $request->route('id'), 'user_id' => auth()->user()->id])->get();

        if ($chatroom->user_id == auth()->user()->id || $usersChatRoom->isNotEmpty()) {
            return $next($request);
        } else {
            if ($chatroom->is_public) {
                return $next($request);
            }
        }

        return redirect()->route('chats');
    }
}
