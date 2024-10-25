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
            ['slug' => 'admin', "title" => ['en' => 'Admin', 'es' => 'Administrador', 'ru' => 'Администратор']],
            ['slug' => 'manager', "title" => ['en' => 'Manager', 'es' => 'Gerente', 'ru' => 'Менеджер']],
            ['slug' => 'user', "title" => ['en' => 'User', 'es' => 'Usuario', 'ru' => 'Пользователь']]
        ];
        foreach ($roles as $role) {
            Role::create([
                'slug' => $role['slug'],
                'title' => $role['title'],
            ]);
        }
        // for admin add all permissions
        $admin = Role::where('slug', 'admin')->first();
        $permissions = Permission::all();
        $admin->permissions()->attach($permissions);

        // for user with id add role admin
        $user = User::findOrFail(1);
        $user->roles()->attach($admin);
    }
}
