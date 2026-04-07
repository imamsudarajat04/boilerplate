<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Enums\Role;
use App\Models\User;


class UserSeeder extends Seeder
{
    public const array DATA_USER = [
        [
            "id" => "9d52d0f0-d0fa-44a4-b587-346706efcb01",
            "first_name" => "Imam",
            "last_name" => "Sudarajat",
            "email" => "superadmin@mail.com",
            "password" => "password",
            "is_active" => true,
            "roles" => [
                Role::SUPER_ADMIN->value,
            ],
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::DATA_USER as $user) {
            $roles = $user['roles'];
            unset($user['roles']);
            $createdUser = User::query()->create($user);
            $createdUser->assignRole($roles);
        }
    }
}
