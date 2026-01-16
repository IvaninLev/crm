<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(Request $request): array
    {
        return [
            "name" => ['required', 'string'],
            "email" => ['bail','required', 'email'],
            "avatar" => ['bail','nullable', 'image', 'mimes:jpg,png'],
            "password" => ['bail', 'confirmed'],
            "password_confirmation"=>[
                Rule::requiredIf(strlen($request->input('password')) > 0)
            ],
            "task" =>['required', 'string']
        ];
    }
}
