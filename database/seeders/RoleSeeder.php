<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Role;
use App\Enums\Permission;

class RoleSeeder extends Seeder
{
    private const GUARD_NAME = 'web';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Role::cases() as $role) {
            \App\Models\Role::query()->create([
                "name"       => $role->value,
                "guard_name" => self::GUARD_NAME,
                "is_mutable" => false,
            ]);
        }

        $role = \App\Models\Role::query()->where("name", Role::SUPER_ADMIN->value)->first();
        foreach (Permission::all() as $permission) {
            $role->givePermissionTo($permission->value);
        }
    }
}
