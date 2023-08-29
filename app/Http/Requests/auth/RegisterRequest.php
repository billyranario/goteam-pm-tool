<?php

namespace App\Http\Requests\auth;

use App\Dtos\UserDto;
use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:128'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'min:8',
                'max:16',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ]
        ];
    }

    /**
     * Transform request to data transfer object.
     * @return UserDto
     */
    public function toDto(): UserDto
    {
        $userDto = new UserDto();
        $userDto->setName($this->getInputAsString('name'));
        $userDto->setEmail($this->getInputAsString('email'));
        $userDto->setPassword($this->getInputAsString('password'));

        return $userDto;
    }
}
