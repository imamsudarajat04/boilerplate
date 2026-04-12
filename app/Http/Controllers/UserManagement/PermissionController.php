<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    /**
     * Display a read-only list of permissions.
     */
    public function index(PermissionService $service): Response
    {
//        dd($service->getAllData());
        return Inertia::render('user-management/Permissions/Index', $service->getAllData());
    }
}
