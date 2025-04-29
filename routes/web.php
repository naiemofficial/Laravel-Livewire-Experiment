<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookieController;
use \App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/todo', [TodoController::class, 'index']);

Route::post('/todo', [TodoController::class, 'store']);




Route::get("/cookie/{name}", [CookieController::class, 'show'])->name('cookie.show');
Route::post("/cookie", [CookieController::class, 'store'])->name('cookie.store');
