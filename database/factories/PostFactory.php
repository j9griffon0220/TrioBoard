<?php

namespace Database\Factories;

use Avifinfo\Tile;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Thread;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // idとtimestampは自動生成されるので指定しない
            'title' => fake()->sentence(),
            'body' => fake()->text(),
            'user_id' => User::factory(),
            'thread_id' => Thread::factory(),
            'is_edited' => fake()->boolean(),
        ];
    }
}
