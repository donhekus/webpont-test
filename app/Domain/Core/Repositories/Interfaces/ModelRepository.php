<?php

namespace App\Domain\Core\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Interface EloquentModelRepository
 * @package App\Domain\Core\Repositories\Interfaces
 */
interface ModelRepository
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @return Collection<Model>
     */
    public function all(): Collection;

    /**
     * @param array $where
     * @return Model|null
     */
    public function findByFields(array $where): ?Model;

    /**
     * @param array $where
     * @return Collection<Model>
     */
    public function getByFields(array $where): Collection;
}
