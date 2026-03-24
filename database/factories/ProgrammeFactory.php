<?php

namespace Database\Factories;

use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Programme>
 */
class ProgrammeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'slug' => fn (array $attributes) => str($attributes['name'])->slug(),
            'short_name' => fn (array $attributes) => str($attributes['name'])->upper()->substr(0, 3),
            'excerpt' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'age_range' => '5-10',
            'curriculum_type' => 'IB PYP',
            'sort_order' => 0,
            'is_featured' => true,
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}
