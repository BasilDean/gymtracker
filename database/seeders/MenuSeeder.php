<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'slug' => 'admin_header',
            'title' => ['en' => 'Admin header menu', 'es' => 'Menú de encabezado de administrador', 'ru' => 'Административное меню в шапке'],
            'type' => 'private',
            'placement' => 'header',
        ]);
    }
}
