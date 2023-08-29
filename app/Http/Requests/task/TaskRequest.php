<?php

namespace App\Http\Requests\task;

use App\Http\Requests\BaseRequest;
use App\Traits\Requests\TaskRequestDtoTrait;

class TaskRequest extends BaseRequest
{
    use TaskRequestDtoTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }
}
