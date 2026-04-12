<?php

use App\Http\Controllers\UserManagement\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('user-management/permissions', [PermissionController::class, 'index'])
        ->name('user-management.permissions.index');
});
