<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Basil Dandelion',
            'email' => 'vonavud@gmail.com',
            'password' => 'vonavud@gmail.com',
        ]);


        $this->call(CreatePermissionsForRolesSeeder::class);
        $this->call(CreateRolesSeeder::class);
        // TODO comment before pushing to production
        $this->call(MenuSeeder::class);
        $this->call(MenuItemSeeder::class);
    }

}

