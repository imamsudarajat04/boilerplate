<?php

namespace App\Enums;

enum Table: string
{
    case USERS = "users";
    case PASSWORD_RESET_TOKENS = "password_reset_tokens";
    case SESSIONS = "sessions";

    # Cache
    case CACHE = "cache";
    case CACHE_LOCKS = "cache_locks";

    # Jobs
    case JOBS = "jobs";
    case JOB_BATCHES = "job_batches";
    case FAILED_JOBS = "failed_jobs";
}
