<?php

namespace App\Repositories;

use App\Contracts\Repositories\Abstracts\BaseRepository;
use App\Models\User;
use App\Support\Attributes\ForModel;

#[ForModel(User::class)]
class UserRepository extends BaseRepository
{
    //
}
