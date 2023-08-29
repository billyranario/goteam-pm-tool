<?php

namespace App\Http\Controllers;

use App\Core\ResponseHelper;
use App\Http\Requests\auth\{
    LoginRequest,
    RegisterRequest
};
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @var AuthService $authService
     */
    private AuthService $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login user.
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $serviceResponse = $this->authService->login($request->toDto());

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::json($serviceResponse->getData());
    }

    /**
     * Register user.
     * @param RegisterRequest $request
     * @return JsonResponse|UserResource
     */
    public function register(RegisterRequest $request): JsonResponse|UserResource
    {
        $serviceResponse = $this->authService->register($request->toDto());

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::resource(UserResource::class, $serviceResponse->getData());
    }

    /**
     * Logout user.
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $serviceResponse = $this->authService->logout();

        if ($serviceResponse->isError()) {
            return ResponseHelper::error($serviceResponse->getMessage());
        }

        return ResponseHelper::json($serviceResponse->getMessage());
    }
}
