<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'slug' => 'admin',
            'title' => ['en' => 'Admin', 'es' => 'Administrador', 'ru' => 'Администратор'],
            'type' => 'private',
            'placement' => 'header',
        ]);
    }
}
