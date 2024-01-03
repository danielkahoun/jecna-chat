/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface ChatRoom {
        id: number;
        name: string;
        description: string | null;
        user_id: string;
        is_public: boolean;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Message {
        id: number;
        chat_room_id: number;
        user_id: number;
        message: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface User {
        id: number;
        username: string;
        password: string;
        remember_token: string | null;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface UsersChatRooms {
        id: number;
        user_id: number;
        chat_room_id: number;
        created_at: string | null;
        updated_at: string | null;
    }

}
