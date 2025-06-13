<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

Route::post('/chat', [App\Http\Controllers\ChatController::class, 'chat'])->name('chat');
