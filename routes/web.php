<?php

use Illuminate\Support\Facades\Route;

Route::prefix("auth")->name("auth")->controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
    Route::get("", "login")->name("login");
    Route::post("authenticate", "authenticate")->name("authenticate");
    Route::post("logout", "logout")->name("logout");
});
