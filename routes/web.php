<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookieController;

Route::get('/', function () {
    return view('welcome');
});



Route::get("/livewire", function(){
    return view("livewire.first-component");
});



Route::post("/cookie", [CookieController::class, 'store'])->name('cookie.store');
Route::get("/cookie/{name}/", [CookieController::class, 'show'])->name('cookie.show');
