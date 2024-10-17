<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'url' => ['nullable'],
            'route' => ['nullable'],
            'menu_id' => ['required', 'exists:menus'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
