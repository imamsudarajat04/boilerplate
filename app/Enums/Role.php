<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = "Super-Admin";
    case ADMIN = "Admin";
    case STAFF = "Staff";
}