<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostsController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//Route::get('/', [PostsController::class, 'home'])->name('posts.home');
//Route::get('/create', [PostsController::class, 'create'])->name('posts.create');


Route::prefix('/')
    ->name('posts.')
    ->group(function () {
        Route::get('/', [PostsController::class, 'home'])->name('home');
        Route::get('/create', [PostsController::class, 'create'])->name('create');
        Route::post('/',[PostsController::class, 'store'])->name('store'); //post 생성 요청

    });


