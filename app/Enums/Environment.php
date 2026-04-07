<?php

namespace App\Enums;

enum Environment: string
{
    case PRODUCTION = "production";
    case DEVELOPMENT = "development";
    case STAGING = "staging";
    case LOCAL = "local";
    case TESTING = "testing";
}
