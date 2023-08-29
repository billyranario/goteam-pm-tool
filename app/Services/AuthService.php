<?php

namespace App\Services;

use App\Constants\ServiceResponseMessages;
use App\Core\ServiceResponse;
use App\Dtos\UserDto;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserDto $userDto
     * @return ServiceResponse
     */
    public function register(UserDto $userDto): ServiceResponse
    {
        $data = [
            'name' => $userDto->getName(),
            'email' => $userDto->getEmail(),
            'password' => Hash::make($userDto->getPassword()),
        ];

        if ($user = $this->userRepository->create($data)) {
            return ServiceResponse::success(ServiceResponseMessages::REGISTER_SUCCESS, $user);
        }

        return ServiceResponse::error(ServiceResponseMessages::REGISTER_ERROR);
    }

    /**
     * @param UserDto $userDto
     * @return ServiceResponse
     */
    public function login(UserDto $userDto): ServiceResponse
    {
        $user = $this->userRepository->findByEmail($userDto->getEmail());

        if (!$user) {
            return ServiceResponse::error(ServiceResponseMessages::EMAIL_NOT_FOUND);
        }
        if (!Hash::check($userDto->getPassword(), $user->password)) {
            return ServiceResponse::error(ServiceResponseMessages::INCORRECT_PASSWORD);
        }

        return ServiceResponse::success(
            ServiceResponseMessages::LOGIN_SUCCESS, 
            $user->createToken('auth-token')->plainTextToken
        );
    }
}
