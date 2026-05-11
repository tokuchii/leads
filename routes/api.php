<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VisitorController;

Route::post('/chat', [ChatController::class, 'chat'])->name('api.chat');

Route::post('/track-visit', [VisitorController::class, 'track']);
Route::get('/visitor-stats', [VisitorController::class, 'stats']);
