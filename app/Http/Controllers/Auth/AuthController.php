<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\Auth\AuthenticateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @return Response
     */
    public function login(): Response
    {
        return response()->view('auth.login');
    }

    /**
     * @param AuthenticateService $service
     * @param AuthenticateRequest $request
     * @return RedirectResponse
     */
    public function authenticate(AuthenticateService $service, AuthenticateRequest $request): RedirectResponse
    {
        $response = $service->authenticate($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

//        if (Auth::user()->hasPermissionTo(Permission::DASHBOARD_SHOW->value) || Auth::user()->hasRole(Role::SUPER_ADMIN->value)) {
            return redirect()->intended('/');
//        } else {
//            return redirect()->intended('/profile');
//        }

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
