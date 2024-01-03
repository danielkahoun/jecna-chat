<?php

use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/chats', [ChatRoomController::class, 'index'])->name('chats');
    Route::get('/chats/create', [ChatRoomController::class, 'create'])->name('chats.create');
    Route::get('/chats/{id}', [ChatRoomController::class, 'show'])->name('chats.show')->middleware('access');
    Route::post('/chats', [ChatRoomController::class, 'store'])->name('chats.store');
    Route::post('/chats/{id}/messages', [MessageController::class, 'store'])->name('messages.store');
});

require __DIR__.'/auth.php';
