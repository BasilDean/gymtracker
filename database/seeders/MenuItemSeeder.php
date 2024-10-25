<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $menuItems = [
            [
                'slug' => 'roles',
                'title' => [
                    'en' => 'Roles',
                    'es' => 'Puestos',
                    'ru' => 'Роли',
                ],
                'route' => 'role.index',
                'menu_id' => 1
            ],
            [
                'slug' => 'menus',
                'title' => [
                    'en' => 'Menu',
                    'es' => 'Menú',
                    'ru' => 'Меню',
                ],
                'route' => 'menu.index',
                'menu_id' => 1
            ],
        ];

        foreach ($menuItems as $menuItem) {
            MenuItem::create($menuItem);
        }
    }
}
