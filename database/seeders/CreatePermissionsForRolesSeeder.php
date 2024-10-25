<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use JsonException;

class CreatePermissionsForRolesSeeder extends Seeder
{
    /**
     * @throws JsonException
     */
    public function run(): void
    {
        $permissionsForRoles = [
            ['slug' => 'view_dashboard', 'titles' => ['en' => 'View dashboard', 'es' => 'Ver panel', 'ru' => 'Просмотр панели']],
            ['slug' => 'view_any_role', 'titles' => ['en' => 'View any role', 'es' => 'Ver cualquier rol', 'ru' => 'Просмотр любой роли']],
            ['slug' => 'view_role', 'titles' => ['en' => 'View role', 'es' => 'Ver rol', 'ru' => 'Просмотр роли']],
            ['slug' => 'create_role', 'titles' => ['en' => 'Create role', 'es' => 'Crear rol', 'ru' => 'Создание роли']],
            ['slug' => 'update_role', 'titles' => ['en' => 'Update role', 'es' => 'Actualizar rol', 'ru' => 'Обновление роли']],
            ['slug' => 'delete_role', 'titles' => ['en' => 'Delete role', 'es' => 'Eliminar rol', 'ru' => 'Удаление роли']],
            ['slug' => 'view_menu', 'titles' => ['en' => 'View menu', 'es' => 'Ver menú', 'ru' => 'Просмотр меню']],
            ['slug' => 'create_menu', 'titles' => ['en' => 'Create menu', 'es' => 'Crear menú', 'ru' => 'Создание меню']],
            ['slug' => 'update_menu', 'titles' => ['en' => 'Update menu', 'es' => 'Actualizar menú', 'ru' => 'Обновление меню']],
            ['slug' => 'delete_menu', 'titles' => ['en' => 'Delete menu', 'es' => 'Delete menú', 'ru' => 'Удаление меню']],
        ];
        foreach ($permissionsForRoles as $permission) {
            Permission::create(['slug' => $permission['slug'], 'title' => $permission['titles']]);
        }
    }
}
