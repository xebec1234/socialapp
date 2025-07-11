<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Post;

Route::get('/', function () {

    $posts = [];
    if(auth()->check()){
        $posts = auth()->user()->userPost()->latest()->get();
    }

    return view('home', ['posts' => $posts]);
});

//auth route
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

//blog post route
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'editPost']);
Route::put('edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('delete-post/{post}', [PostController::class, 'deletePost']);