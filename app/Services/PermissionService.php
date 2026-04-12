<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use App\Support\Attributes\Repository;
use Illuminate\Support\Collection;

#[Repository(PermissionRepository::class)]
final readonly class PermissionService
{
    public function __construct(
        private readonly PermissionRepository $permissionRepository,
    ) {}

    /**
     * @return array
     */
    // TODO: Create Pagination For List All Permissions
    public function getAllData(): array
    {
        return [
            'permissions' => $this->permissionRepository->getAllDataPermissions(),
            'title' => 'Permissions',
            'description' => 'View all permissions in the system. This page is read-only.',
        ];
    }
}
