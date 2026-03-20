<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChatBotController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registers', [RegisterController::class, 'show']);
    Route::post('/registers', [RegisterController::class, 'store']);

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{user}', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/{user}/poll', [ChatController::class, 'poll'])->name('chat.poll');
  
});
Route::prefix('chatbot')->name('chatbot.')->group(function () {
    Route::get('/',       [ChatBotController::class, 'index'])->name('index');
    Route::post('/send',  [ChatBotController::class, 'sendMessage'])->name('send');
    Route::post('/clear', [ChatBotController::class, 'clearHistory'])->name('clear');
});

  Route::get('/debug-session', function() {
        return session('chat_history');
    });
require __DIR__.'/auth.php';




