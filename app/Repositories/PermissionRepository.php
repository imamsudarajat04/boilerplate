<?php

namespace App\Repositories;

use App\Contracts\Repositories\Abstracts\BaseRepository;
use App\Models\Permission;
use App\Support\Attributes\ForModel;
use Illuminate\Support\Collection;

#[ForModel(Permission::class)]
class PermissionRepository extends BaseRepository
{
    /**
     * @return Collection
     */
    public static function getAllDataPermissions(): Collection
    {
        return Permission::query()
            ->orderBy('feature_group')
            ->orderBy('name')
            ->get()
            ->map(fn (Permission $permission) => [
                'id' => $permission->id,
                'name' => $permission->name,
                'label' => $permission->label,
                'description' => $permission->description,
                'feature_group' => $permission->feature_group,
                'guard_name' => $permission->guard_name,
                'updated_at' => $permission->updated_at?->toIso8601String(),
            ]);
    }
}
