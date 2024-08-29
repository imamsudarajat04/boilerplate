<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.layouts.dashboard.layout', ['_title' => 'Testing']);
});
