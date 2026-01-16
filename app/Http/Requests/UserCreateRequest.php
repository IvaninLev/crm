<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required', 'string'],
            "email" => ['bail', 'required', 'email', 'unique:users,email'],
            "avatar" => ['bail', 'nullable', 'image', 'mimes:jpg,png'],
            "password" => ['bail', 'required', 'confirmed'],
            "password_confirmation" => ['required'],
            "task" => ['required', 'string'],
            'role' => ['required', 'in:user,admin']
        ];
    }
}
