<?php

namespace App\Models;

use App\Enums\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Permission as SpatiePermission;

#[Fillable(['name', 'guard_name', 'label', 'description', 'feature_group'])]
#[Table(Table::PERMISSIONS->value)]
class Permission extends SpatiePermission
{
    use HasUuids;
}
