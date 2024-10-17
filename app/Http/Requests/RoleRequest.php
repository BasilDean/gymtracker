<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        $roleId = $this->route('id');
        return [
            'title' => 'required|array',
            'title.en' => 'required|string|max:255|unique:roles,title->en' . $roleId,
            'title.*' => 'required|string|max:255',
            'permissions' => 'array',
        ];
    }

    public function authorize(): bool
    {
        foreach (Auth::user()->roles as $role) {
            if ($role->hasPermissionTo('create_role')) {
                return true;
            }
        }
        return false;
    }
}
