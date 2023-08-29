<?php

namespace App\Http\Controllers;

use App\Core\ResponseHelper;
use App\Http\Requests\task\{
    TaskRequest,
    TaskCreateUpdateRequest
};
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    /**
     * @var TaskService $taskService
     */
    private TaskService $taskService;

    /**
     * TaskController constructor.
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     * @param TaskRequest $request
     * @return JsonResponse|TaskResource
     */
    public function index(TaskRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $serviceResponse = $this->taskService->getAll($request->toDto());

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::resource(TaskResource::class, $serviceResponse->getData());
    }

    /**
     * Store a newly created resource in storage.
     * @param TaskCreateUpdateRequest $request
     * @return JsonResponse|TaskResource
     */
    public function store(TaskCreateUpdateRequest $request): JsonResponse|TaskResource
    {
        $serviceResponse = $this->taskService->create($request->toDto());

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::resource(TaskResource::class, $serviceResponse->getData());
    }

    /**
     * Display the specified resource.
     * @param TaskRequest $request
     * @param string $id
     * @return JsonResponse|TaskResource
     */
    public function show(TaskRequest $request, string $id): JsonResponse|TaskResource
    {
        $taskDto = $request->toDto();
        $taskDto->setId((int) $id);

        $serviceResponse = $this->taskService->getById($taskDto);

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::resource(TaskResource::class, $serviceResponse->getData());
    }

    /**
     * Update the specified resource in storage.
     * @param TaskCreateUpdateRequest $request
     * @param string $id
     * @return JsonResponse|TaskResource
     */
    public function update(TaskCreateUpdateRequest $request, string $id)
    {
        $taskDto = $request->toDto();
        $taskDto->setId((int) $id);

        $serviceResponse = $this->taskService->update($taskDto);

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::resource(TaskResource::class, $serviceResponse->getData());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskRequest $request, string $id)
    {
        $taskDto = $request->toDto();
        $taskDto->setId((int) $id);

        $serviceResponse = $this->taskService->delete($taskDto);

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::resource(TaskResource::class, $serviceResponse->getData());
    }
}
