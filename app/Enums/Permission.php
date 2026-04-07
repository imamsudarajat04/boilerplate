<?php

namespace App\Enums;

use App\Enums\Permissions\UserPermission;
use App\Enums\Permissions\RolePermission;
use App\Enums\Permissions\AclPermission;

enum Permission: string
{
    public static function all(): array
    {
        return [
            ...UserPermission::cases(),
            ...RolePermission::cases(),
            ...AclPermission::cases(),
        ];
    }

    public static function toSeederArray(): array
    {
        return array_map(fn($p) => [
            'name'          => $p->value,
            'label'         => $p->label(),
            'description'   => $p->description(),
            'feature_group' => $p->featureGroup(),
        ], self::all());
    }
}
