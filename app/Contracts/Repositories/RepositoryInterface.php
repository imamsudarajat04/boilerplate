<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    const int perPage = 20;

    public function fetchAll(array $filters = []): Collection;

    public function fetchPaginated(int $perPage = self::perPage, array $filter = []): LengthAwarePaginator;

    public function fetchById(string|int $id): ?Model;

    public function fetchByIdOrFail(string|int $id): Model;

    public function fetchByOrder(string $columns, string $direction = 'asc'): Collection;

    public function store(array $data): Model;

    public function modify(string|int $id, array $data): Model;

    public function remove(string|int $id): bool;
}
