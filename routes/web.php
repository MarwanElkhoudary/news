<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/category/{category}', [NewsController::class, 'category'])->name('category');
Route::get('/search', [NewsController::class, 'search'])->name('search');
Route::get('/article', [NewsController::class, 'show'])->name('article.show');
