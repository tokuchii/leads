<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ChatController;

Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');


Route::post('/chat', [ChatController::class, 'chat'])->name('chat');
Route::get('/faq', [ChatController::class, 'getFAQ'])->name('faq');
