<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->word(),
            'title' => json_encode(array('en' => $this->faker->word(), 'es' => $this->faker->word(), 'ru' => $this->faker->word())),
            'type' => $this->faker->randomElement(['private', 'public']),
            'placement' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
