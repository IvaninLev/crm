<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskCreateRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules():array
    {
        return [
            "title"=>['required', 'string'],
            "description"=>['nullable','string']
        ];
    }
}
