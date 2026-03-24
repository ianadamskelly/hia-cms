<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => fn (array $attributes) => str($attributes['title'])->slug(),
            'template' => 'default',
            'excerpt' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}
