<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_fr' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
        ];
    }
}
