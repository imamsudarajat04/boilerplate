<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Permission::toSeederArray() as $permission) {
            \App\Models\Permission::query()->create([
                'name'          => $permission['name'],
                'label'         => $permission['label'],
                'description'   => $permission['description'],
                'feature_group' => $permission['feature_group'],
                'guard_name'    => 'web',
            ]);
        }
    }
}
