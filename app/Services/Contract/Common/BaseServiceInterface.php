<?php

namespace App\Services\Contract\Common;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

interface BaseServiceInterface
{
    /**
     * Set with for repository querying
     *
     * @param array $with
     * @return BaseServiceInterface
     */
    public function with(array $with): BaseServiceInterface;

    /**
     * Set withCount for repository querying
     *
     * @param array $withCount
     * @return BaseServiceInterface
     */
    public function withCount(array $withCount): BaseServiceInterface;

    /**
     * Include soft deleted records to a query
     *
     * @return BaseServiceInterface
     */
    public function withTrashed(): BaseServiceInterface;

    /**
     * Show only soft deleted records in a query
     *
     * @return BaseServiceInterface
     */
    public function onlyTrashed(): BaseServiceInterface;

    /**
     * Exclude soft deleted records from a query
     *
     * @return BaseServiceInterface
     */
    public function withoutTrashed(): BaseServiceInterface;

    /**
     * Get filtered results
     *
     * @param array $search
     * @param int $pageSize
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(array $search = [], int $pageSize = 15): LengthAwarePaginator;

    /**
     * Get all records as collection
     *
     * @param array $search
     * @return EloquentCollection
     */
    public function getAll(array $search = []): EloquentCollection;

    /**
     * Get all records as lazy collection (cursor)
     *
     * @param array $search
     * @return LazyCollection
     */
    public function getAllAsCursor(array $search = []): LazyCollection;

    /**
     * Get results count
     *
     * @throws RepositoryException
     */
    public function count(array $search = []): int;

    /**
     * Find or fail the model
     *
     * @param $key
     * @param string|null $column
     * @return Model
     */
    public function findOrFail($key, string $column = null): Model;

    /**
     * Find models by attributes
     *
     * @param array $attributes
     * @return Collection
     */
    public function find(array $attributes): Collection;

    /**
     * Create model
     *
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model;

    /**
     * Create many models
     *
     * @param array $attributes
     * @return Collection
     */
    public function createMany(array $attributes): Collection;

    /**
     * Insert data into db
     *
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool;

    /**
     * Update or create model
     *
     * @param array $attributes
     * @param array $data
     * @return Model|null
     */
    public function updateOrCreate(array $attributes, array $data): ?Model;

    /**
     * Update model
     *
     * @param mixed $keyOrModel
     * @param array $data
     * @return Model|null
     */
    public function update($keyOrModel, array $data): ?Model;

    /**
     * Delete model
     *
     * @param mixed $keyOrModel
     * @return bool
     * @throws Exception
     */
    public function delete($keyOrModel): bool;

    /**
     * Delete many records
     *
     * @param array $keysOrModels
     * @return void
     */
    public function deleteMany(array $keysOrModels): void;

    /**
     * Soft delete model
     *
     * @param $keyOrModel
     * @return void
     */
    public function softDelete($keyOrModel): void;

    /**
     * Restore model
     *
     * @param $keyOrModel
     * @return void
     */
    public function restore($keyOrModel): void;
}