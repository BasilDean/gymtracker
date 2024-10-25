<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function rules(): array
    {
        $menuId = $this->route('id');
        return [
            'title' => 'required',
            'title.en' => 'required|string|max:255|unique:menus,title->en' . $menuId,
            'type' => 'required|string|in:' . implode(',', Menu::$types),
            'placement' => 'required|string|in:' . implode(',', config('menu_placements')),
            'order' => 'nullable|integer',
        ];
    }

    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasPermissionTo('view_dashboard');
    }
}
