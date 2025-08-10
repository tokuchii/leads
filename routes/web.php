<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InquiryCareerController;
use App\Http\Controllers\ChatController;

Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
Route::post('/career-application', [InquiryCareerController::class, 'store'])->name('career.store');
Route::post('/chat', [ChatController::class, 'chat'])->name('chat');
Route::get('/faq', [ChatController::class, 'getFAQ'])->name('faq');
Route::get('/chat-test', [ChatController::class, 'test'])->name('chat.test');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
