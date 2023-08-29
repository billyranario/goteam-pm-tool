<?php

namespace App\Http\Controllers;

use App\Core\ResponseHelper;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserService $userService
     */
    private UserService $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the specified resource.
     * @param TaskRequest $request
     * @param string $id
     * @return JsonResponse|UserResource
     */
    public function me(): JsonResponse|UserResource
    {
        $serviceResponse = $this->userService->getAuthUser();

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::resource(UserResource::class, $serviceResponse->getData());
    }

}
