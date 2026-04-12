<?php

namespace App\Contracts\Repositories\Abstracts;

use App\Contracts\Repositories\RepositoryInterface;
use App\Support\Attributes\ForModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use ReflectionClass;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    private function resolveModel(): Model
    {
        $reflection = new ReflectionClass(static::class);
        $attributes = $reflection->getAttributes(ForModel::class);

        if (empty($attributes)) {
            throw new \InvalidArgumentException(
                'Repository ['.static::class.'] must have ForModel attributes'
            );
        }

        $modelClass = $attributes[0]->newInstance()->modelClass;

        if (! class_exists($modelClass)) {
            throw new \InvalidArgumentException(
                "Model class [{$modelClass}] does not exist."
            );
        }

        return app($modelClass);
    }

    public function fetchAll(array $filters = []): Collection
    {
        return $this->model->latest()->get();
    }

    public function fetchPaginated(int $perPage = self::perPage, array $filter = []): LengthAwarePaginator
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function fetchById(int|string $id): ?Model
    {
        return $this->model->find($id);
    }

    public function fetchByIdOrFail(int|string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function fetchByOrder(string $columns, string $direction = 'asc'): Collection
    {
        return $this->model->orderBy($columns, $direction)->get();
    }

    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    public function modify(int|string $id, array $data): Model
    {
        $model = $this->fetchByIdOrFail($id);
        $model->update($data);

        return $model->fresh();
    }

    public function remove(int|string $id): bool
    {
        return $this->fetchByIdOrFail($id)->delete();
    }
}
