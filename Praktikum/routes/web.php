<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;use App\Http\Controllers\PhotoController;

Route::get('/hello', [WelcomeController::class, 'hello']);

Route::get('/world', function () {
    return 'World';
    });
    
    // --- Rute yang diubah ke PageController ---
    Route::get('/', [PageController::class, 'index']);
    Route::get('/about', [PageController::class, 'about']);
    Route::get('/articles/{id}', [PageController::class, 'articles']);
    // ------------------------------------------
    
    Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
        return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
        });
        
        Route::get('/user/{name?}', function ($name='John') { 
            return 'Nama saya '.$name;
            });
    // route photo controller
    Route::resource('photos', PhotoController::class)->only([
        'index', 'show'
    ]);
    
    Route::get('/greeting', [WelcomeController::class, 'greeting']);