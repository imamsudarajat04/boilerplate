<?php

namespace App\Enums;

#[\Attribute]
enum Table: string
{
    // Core
    case USERS = 'users';
    case PASSWORD_RESET_TOKENS = 'password_reset_tokens';
    case SESSIONS = 'sessions';

    // Cache
    case CACHE = 'cache';
    case CACHE_LOCKS = 'cache_locks';

    // Jobs
    case JOBS = 'jobs';
    case JOB_BATCHES = 'job_batches';
    case FAILED_JOBS = 'failed_jobs';

    // Access Control
    case ROLES = 'roles';
    case PERMISSIONS = 'permissions';
    case MODEL_HAS_ROLES = 'model_has_roles';
    case MODEL_HAS_PERMISSIONS = 'model_has_permissions';
    case ROLE_HAS_PERMISSIONS = 'role_has_permissions';
}
