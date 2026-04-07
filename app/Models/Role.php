<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Enums\Table;
use Carbon\Carbon;

/**
 * @property string id
 * @property string name
 * @property string guard_name
 * @property boolean is_mutable
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
