<?php

use App\Http\Controllers\BibleReadyController;
use Illuminate\Support\Facades\Route;

Route::get('/bolls-life/bible-ready', BibleReadyController::bollsChapter(...))
    ->name('bolls-life-bible-ready');
Route::view('bible-ready-main', 'bible-ready-main')->name('bible-ready-main');
Route::get('/', BibleReadyController::index(...));
