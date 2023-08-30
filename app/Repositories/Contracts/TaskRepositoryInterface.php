<?php

namespace App\Repositories\Contracts;

use App\Models\Task;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    /**
     * Get paginated tasks.
     * @param array $params
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public function getPaginated(array $params, array $relations = []): LengthAwarePaginator;

    /**
     * Find task by id.
     * @param int $id
     * @param array $relations
     * @return Task|null
     */
    public function findById(int $id, array $relations = []): ?Task;

    /**
     * Create a new task.
     * @param array $data
     * @return Task|bool
     */
    public function create(array $data): Task|bool;

    /**
     * Update an existing task.
     * @param int $id
     * @param array $data
     * @return Task|bool
     */
    public function update(int $id, array $data): Task|bool;

    /**
     * Delete a task by id.
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool;
}
