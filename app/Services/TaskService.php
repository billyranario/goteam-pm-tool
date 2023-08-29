<?php

namespace App\Services;

use App\Constants\ServiceResponseMessages;
use App\Core\ServiceResponse;
use App\Dtos\TaskDto;
use App\Repositories\Eloquent\TaskRepository;
use Illuminate\Support\Facades\Log;

class TaskService
{
    /**
     * @var TaskRepository $taskRepository
     */
    private TaskRepository $taskRepository;

    /**
     * TaskService constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get all tasks.
     * @param TaskDto $taskDto
     * @return ServiceResponse
     */
    public function getAll(TaskDto $taskDto): ServiceResponse
    {
        $tasks = $this->taskRepository->getPaginated([
            'keyword' => $taskDto->getSearchKeyword(),
            'orderBy' => $taskDto->getOrderBy(),
            'orderDirection' => $taskDto->getOrderDirection(),
            'perPage' => $taskDto->getPerPage(),
        ], $taskDto->getRelations());

        return ServiceResponse::success('Tasks retrieved successfully.', $tasks);
    }

    /**
     * Get task by id.
     * @param TaskDto $taskDto
     * @return ServiceResponse
     */
    public function getById(TaskDto $taskDto): ServiceResponse
    {
        if ($task = $this->taskRepository->findById($taskDto->getId(), $taskDto->getRelations())) {
            return ServiceResponse::success('Task retrieved successfully.', $task);
        }

        return ServiceResponse::error('Task does not exists.');
    }

    /**
     * Create task.
     * @param TaskDto $taskDto
     * @return ServiceResponse
     */
    public function create(TaskDto $taskDto): ServiceResponse
    {
        $data = [
            'user_id' => $taskDto->getUserId(),
            'title' => $taskDto->getTitle(),
            'description' => $taskDto->getDescription(),
            'due_date' => $taskDto->getDueDate(),
            'status' => $taskDto->getStatus(),
        ];

        if ($task = $this->taskRepository->create($data)) {
            return ServiceResponse::success(ServiceResponseMessages::REGISTER_SUCCESS, $task);
        }

        return ServiceResponse::error(ServiceResponseMessages::REGISTER_ERROR);
    }

    /**
     * Update task.
     * @param TaskDto $taskDto
     * @return ServiceResponse
     */
    public function update(TaskDto $taskDto): ServiceResponse
    {
        $data = [
            'title' => $taskDto->getTitle(),
            'description' => $taskDto->getDescription(),
            'due_date' => $taskDto->getDueDate(),
            'status' => $taskDto->getStatus(),
        ];

        if ($task = $this->taskRepository->update($taskDto->getId(), $data)) {
            return ServiceResponse::success(ServiceResponseMessages::UPDATE_TASK_SUCCESS, $task);
        }

        return ServiceResponse::error(ServiceResponseMessages::UPDATE_TASK_ERROR);
    }

    /**
     * Delete task.
     * @param TaskDto $taskDto
     * @return ServiceResponse
     */
    public function delete(TaskDto $taskDto): ServiceResponse
    {
        if ($this->taskRepository->delete($taskDto->getId())) {
            return ServiceResponse::success(ServiceResponseMessages::DELETE_TASK_SUCCESS);
        }

        return ServiceResponse::error(ServiceResponseMessages::DELETE_TASK_ERROR);
    }
}
