<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        $roleId = $this->route('id');
        return [
            'title' => 'required',
            'title.en' => 'required|string|max:255|unique:roles,title->en' . $roleId,
            'title.*' => 'required|string|max:255',
            'permissions' => 'array',
        ];
    }

    public function authorize(): bool
    {
        // authorize if user is logged in and has view_dashboard permission

        return auth()->check() && auth()->user()->hasPermissionTo('view_dashboard');
    }
}
