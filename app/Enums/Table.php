<?php

namespace App\Enums;

enum Table: string
{
    case PERMISSIONS = "permissions";
    case ROLES = "roles";
    case MODEL_HAS_PERMISSIONS = "model_has_permissions";
    case MODEL_HAS_ROLES = "model_has_roles";
    case ROLE_HAS_PERMISSIONS = "role_has_permissions";
    case USERS = "users";
}
