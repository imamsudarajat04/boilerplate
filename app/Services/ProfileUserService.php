<?php

namespace App\Services;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

final readonly class ProfileUserService
{
    /**
     * Props for Inertia `settings/Profile` page.
     *
     * @return array{mustVerifyEmail: bool, status: mixed, roles: list<string>, permissions: list<string>}
     */
    public function editProfile(Request $request): array
    {
        $user = $request->user();

        return [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => $request->session()->get('status'),
            'roles' => $user->roles->pluck('name')->values()->all(),
            'permissions' => $user->getPermissionsViaRoles()
                ->pluck('name')
                ->unique()
                ->sort()
                ->values()
                ->all(),
        ];
    }
}
