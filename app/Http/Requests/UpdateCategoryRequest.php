<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_fr' => ['sometimes', 'required', 'string', 'max:255'],
            'name_ar' => ['sometimes', 'required', 'string', 'max:255'],
        ];
    }
}
