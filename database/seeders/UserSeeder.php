<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public const array DATA_USER = [
        [
            'id' => '9d52d0f0-d0fa-44a4-b587-346706efcb01',
            'first_name' => 'Imam',
            'last_name' => 'Sudarajat',
            'email' => 'superadmin@mail.com',
            'password' => 'password',
            'is_active' => true,
            'roles' => [
                Role::SUPER_ADMIN->value,
            ],
        ],
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

            $createdUser->forceFill(['email_verified_at' => now()])->save();
        }
    }
}
