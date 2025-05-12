<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return redirect('/todos');
});


Route::get('/todos', [TodoController::class, 'index']);
