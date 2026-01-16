<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskCompleteRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules():array
    {
        return [
            'complete'=>['sometimes','bool']
        ];
    }
}
