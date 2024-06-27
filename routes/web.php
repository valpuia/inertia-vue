<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::post('/lang/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
})->name('locale');

Route::controller(LoginController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'show')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
});

Route::middleware('web')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');

    Route::resource('posts', PostController::class)->except('index', 'show')
        ->whereNumber('id');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
});
