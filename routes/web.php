<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/menia', [PageController::class, 'menia'])->name('menia');
Route::get('/oprema', [PageController::class, 'oprema'])->name('oprema');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
