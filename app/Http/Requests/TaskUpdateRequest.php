<?php

namespace App\Http\Requests;

use App\Models\TodoList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TaskUpdateRequest extends FormRequest
{

    public function rules(Request $request): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'nullable'],
            'status' => ['required', 'int']
        ];

    }
}
