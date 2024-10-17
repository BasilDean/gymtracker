<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'type' => ['required'],
            'route' => ['nullable'],
            'url' => ['nullable'],
            'placement' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
