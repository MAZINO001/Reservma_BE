<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'phone' => 'nullable|string',
        'avatar' => 'nullable|string',
        'role' => 'required|in:owner,customer',
        'bio' => 'nullable|string',
        'city' => 'nullable|string',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|in:male,female',
    ];
}

        public function messages(): array
    {
         return [
            'email.unique' => 'This email is already registered.',
            'role.in'      => 'Role must be either owner or customer.',
            'password.confirmed' => 'Passwords do not match.',
        ];
    }
}
