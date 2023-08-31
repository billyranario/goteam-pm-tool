<?php

namespace App\Http\Requests\task;

use App\Http\Requests\BaseRequest;
use App\Traits\Requests\TaskRequestDtoTrait;

class TaskCreateRequest extends BaseRequest
{
    use TaskRequestDtoTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['nullable'],
            'dueDate' => ['required', 'date', 'after_or_equal:' . now()->format('Y-m-d')],
            'status' => ['required', 'integer'],
        ];
    }
}
