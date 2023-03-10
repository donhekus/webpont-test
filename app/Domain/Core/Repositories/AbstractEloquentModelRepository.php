<?php

namespace App\Domain\Core\Repositories;

use App\Domain\Core\Repositories\Interfaces\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class AbstractEloquentModelRepository
 * @package App\Domain\Core\Repositories
 */
class AbstractEloquentModelRepository implements ModelRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Model
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->model->newQuery()->get();
    }

    /**
     * @inheritDoc
     */
    public function findByFields(array $where): ?Model
    {
        $query = $this->makeQuery($where);

        return $query->first();
    }

    /**
     * @inheritDoc
     */
    public function getByFields(array $where): Collection
    {
        $query = $this->makeQuery($where);

        return $query->get();
    }

    /**
     * @param array $where
     * @return Builder
     */
    private function makeQuery(array $where): Builder
    {
        $query = $this->model->newQuery();

        foreach ($where as $column => $value) {
            if (is_array($value)) {
                $query->whereIn($column, $value);
            } else {
                $query->where($column, $value);
            }
        }

        return $query;
    }
}
