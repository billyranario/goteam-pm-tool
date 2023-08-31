<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var Task $task
     */
    protected Task $task;

    /**
     * TaskRepository constructor.
     *
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get paginated tasks.
     * @param array $params
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public function getPaginated(array $params, array $relations = []): LengthAwarePaginator
    {
        return $this->task->query()
            ->with($relations)
            ->where(function(Builder $query) use ($params) {
                $query->when($params['keyword'], function (Builder $taskSearchQuery, string $search) {
                    return $taskSearchQuery->where('title', 'like', "%{$search}%");
                });
            })
            ->where('user_id', auth()->id())
            ->orderBy($params['orderBy'], $params['orderDirection'])
            ->paginate($params['perPage']);
    }

    /**
     * Find task by id.
     * @param int $id
     * @param array $relations
     * @return Task|null
     */
    public function findById(int $id, array $relations = []): ?Task
    {
        return $this->task->query()
            ->with($relations)
            ->find($id);
    }

    /**
     * Create task.
     * @param array $data
     * @return Task|bool
     */
    public function create(array $data): Task|bool
    {
        try {
            DB::beginTransaction();

            $task = $this->task->create($data);

            DB::commit();
            return $task;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    
    /**
     * Update task.
     * @param int $id
     * @param array $data
     * @return Task|bool
     */
    public function update(int $id, array $data): Task|bool
    {
        try {
            DB::beginTransaction();

            $task = $this->findById($id);
            $task->update($data);

            DB::commit();
            return $task;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Delete task.
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        if ($task = $this->findById($id)) {
            return $task->delete();
        }

        return null;
    }
}
