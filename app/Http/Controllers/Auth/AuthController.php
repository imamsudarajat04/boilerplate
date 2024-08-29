<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\Auth\AuthenticateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @return Response
     */
    public function login(): Response
    {
        return response()->view('auth.login');
    }

    public function authenticate(AuthenticateService $service, AuthenticateRequest $request): RedirectResponse
    {
        $response = $service->authenticate($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();
    }
}
