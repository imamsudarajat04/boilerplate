<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\Table;

#[Table(Table::ROLES->value)]
#[Fillable(['name', 'guard_name', 'is_mutable'])]
class Role extends SpatieRole
{
    use HasUuids;

    protected $casts = [
        'is_mutable' => 'boolean',
    ];
}
