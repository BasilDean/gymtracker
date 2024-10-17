<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateRolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', "title" => ['en' => 'Admin', 'es' => 'Administrador', 'ru' => 'Администратор']],
            ['name' => 'manager', "title" => ['en' => 'Manager', 'es' => 'Gerente', 'ru' => 'Менеджер']],
            ['name' => 'user', "title" => ['en' => 'User', 'es' => 'Usuario', 'ru' => 'Пользователь']]
        ];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'title' => $role['title'],
            ]);
        }
        // for admin add all permissions
        $admin = Role::where('id', '1')->first();
        $permissions = Permission::all();
        $admin->permissions()->attach($permissions);

        // for user with id add role admin
        $user = User::findOrFail(1);
        $user->roles()->attach($admin);
    }
}
