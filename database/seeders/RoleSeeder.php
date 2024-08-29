<?php

namespace Database\Seeders;

use App\Enums\Permission;
use App\Enums\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public const array DATA_ROLE = [
        [
            "id" => "9b8f868a-2f75-4bb4-af0d-75a1fd5aa921",
            "name" => Role::SUPER_ADMIN->value,
            "guard_name" => "web",
            "is_mutable" => false,
        ],
        [
            "id" => "9b8f868a-2f75-4bb4-af0d-75a1fd5aa922",
            "name" => Role::USER->value,
            "guard_name" => "web",
            "is_mutable" => false,
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::DATA_ROLE as $role) {
            \App\Models\Role::query()->create($role);
        }

        $role = \App\Models\Role::query()->where("name", Role::SUPER_ADMIN->value)->first();
        foreach (Permission::cases() as $permission) {
            $role->givePermissionTo($permission->value);
        }
    }
}
