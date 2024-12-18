<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->name(),
            'title' => json_encode(['en' => $this->faker->jobTitle(), 'es' => $this->faker->jobTitle(), 'ru' => $this->faker->jobTitle()]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
