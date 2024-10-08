<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\WordController;
use App\Http\Controllers\Admin\LoginController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::prefix('admin')->group(function() {
    Route::middleware('guest')->group(function() {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::middleware('auth')->group(function() {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/word', [WordController::class, 'index'])->name('admin.word.index');

        Route::get('/word/create', [WordController::class, 'create'])->name('admin.word.create');
        Route::post('/word/create', [WordController::class, 'store']);

        Route::get('/word/update', [WordController::class, 'edit'])->name('admin.word.edit');
        Route::put('/word/update', [WordController::class, 'update']);
    });
});
