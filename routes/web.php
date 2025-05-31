<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\USerController;

Route::get('/', function () {
    return view('home');
});

Route::post('/register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login']);

Route::post('/logout', [USerController::class, 'logout']);