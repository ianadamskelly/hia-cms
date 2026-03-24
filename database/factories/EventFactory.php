<?php

namespace Database\Factories;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->sentence,
            'location' => $this->faker->city,
            'type' => $this->faker->randomElement(['academic', 'holiday', 'exam', 'event', 'staff']),
            'start_at' => Carbon::now()->addDays(rand(1, 30)),
            'is_published' => true,
        ];
    }
}
