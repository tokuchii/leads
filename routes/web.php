<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InquiryCareerController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NewsOgController;
use App\Http\Controllers\VisitorController;

Route::post('/track-visit', [VisitorController::class, 'track'])->name('track.visit');

Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
Route::post('/career-application', [InquiryCareerController::class, 'store'])->name('career.store');
Route::post('/chat', [ChatController::class, 'chat'])->name('chat');
Route::get('/faq', [ChatController::class, 'getFAQ'])->name('faq');
Route::get('/chat-test', [ChatController::class, 'test'])->name('chat.test');
Route::post('/chat-test-fallback', [ChatController::class, 'testFallback'])->name('chat.test.fallback');

// News article route: serves the Vue SPA with proper Open Graph meta tags
// so social media crawlers (Facebook, Twitter, etc.) can read article previews.
Route::get('/news/{slug}', [NewsOgController::class, 'show'])->where('slug', '.+');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
