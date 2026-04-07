<?php

namespace App\Enums\Permissions;

enum AclPermission: string
{
    case VIEW = "view-permission";

    public function label(): string { return "View Permission"; }
    public function description(): string { return "Allow user to view permissions"; }
    public function featureGroup(): string { return "Access Control"; }
}
