<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('/todos', [TodoController::class, 'index']);
Route::get('/files', [FileController::class, 'index']);




Route::get("/cookie/{name}", [CookieController::class, 'show'])->name('cookie.show');
Route::post("/cookie", [CookieController::class, 'store'])->name('cookie.store');
