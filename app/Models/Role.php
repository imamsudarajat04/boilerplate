<?php

namespace App\Models;

use App\Enums\Table;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property string id
 * @property string name
 * @property string guard_name
 * @property bool is_mutable
 * @property Carbon created_at
 * @property Carbon updated_at
 */
#[Table(Table::ROLES->value)]
#[Fillable(['name', 'guard_name', 'is_mutable'])]
class Role extends SpatieRole
{
    use HasUuids;

    protected $casts = [
        'is_mutable' => 'boolean',
    ];
}
