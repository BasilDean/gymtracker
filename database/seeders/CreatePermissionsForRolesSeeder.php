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
            ['name' => 'view_dashboard', 'titles' => ['en' => 'View dashboard', 'es' => 'Ver panel', 'ru' => 'Просмотр панели']],
            ['name' => 'view_any_role', 'titles' => ['en' => 'View any role', 'es' => 'Ver cualquier rol', 'ru' => 'Просмотр любой роли']],
            ['name' => 'view_role', 'titles' => ['en' => 'View role', 'es' => 'Ver rol', 'ru' => 'Просмотр роли']],
            ['name' => 'create_role', 'titles' => ['en' => 'Create role', 'es' => 'Crear rol', 'ru' => 'Создание роли']],
            ['name' => 'update_role', 'titles' => ['en' => 'Update role', 'es' => 'Actualizar rol', 'ru' => 'Обновление роли']],
            ['name' => 'delete_role', 'titles' => ['en' => 'Delete role', 'es' => 'Eliminar rol', 'ru' => 'Удаление роли']],
        ];
        foreach ($permissionsForRoles as $permission) {
            Permission::create(['name' => $permission['name'], 'title' => $permission['titles']]);
        }
    }
}
