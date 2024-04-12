<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostsController;
use \App\Http\Controllers\CommentController;
use \Illuminate\Support\Facades\Storage;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

//    Route::prefix('/')
//        ->name('posts.')
//        ->group(function () {
//            Route::get('/', [PostsController::class, 'home'])->name('home');
//            Route::get('/create', [PostsController::class, 'create'])->name('create');
//            Route::post('/',[PostsController::class, 'store'])->name('store');
//            Route::delete('/{id}',[PostsController::class,'destroy'])->name('destroy');
//            Route::get('/{id}',[PostsController::class,'edit'])->name('edit');
//            Route::put('/{id}',[PostsController::class,'update'])->name('update');
//        });

    //refactoring controller별 그룹화

    Route::controller(PostsController::class)
        ->prefix('/')
        ->name('posts.')
        ->group(function () {
            Route::get('', 'home')->name('home');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('edit/{id}', 'update')->name('update');
            Route::get('/{id}', 'detail')->name('detail');
        });


    Route::controller(CommentController::class)
        ->prefix('/comment')
        ->name('comment.')
        ->group(function(){
            Route::post('','store')->name('store');
            Route::get('','index')->name('index');
            Route::get('/{id}','edit')->name('edit');
            Route::delete('/{id}','destroy')->name('destroy');
            Route::put('/{id}','update')->name('update');
        });


    Route::get('/storage/images/{filename}',function($filename){
       $path = Storage::disk('public')->path('images/'.$filename);
       return response()->file($path);

    })->name('storage.images.show');

});








