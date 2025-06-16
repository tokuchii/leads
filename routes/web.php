<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;

Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

Route::post('/chat', [App\Http\Controllers\ChatController::class, 'chat'])->name('chat');
