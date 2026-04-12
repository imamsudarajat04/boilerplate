<?php

namespace Tests\Feature\UserManagement;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PermissionIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_permissions_index(): void
    {
        $this->get(route('user-management.permissions.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_permissions_index(): void
    {
        $user = User::factory()->create();

        Permission::query()->create([
            'name' => 'users.view',
            'guard_name' => 'web',
            'label' => 'View users',
            'description' => 'Read-only access to users.',
            'feature_group' => 'Users',
        ]);

        $this->actingAs($user)
            ->get(route('user-management.permissions.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('user-management/Permissions/Index')
                ->has('permissions', 1)
                ->where('permissions.0.name', 'users.view')
                ->where('permissions.0.label', 'View users')
                ->where('permissions.0.feature_group', 'Users')
            );
    }
}
