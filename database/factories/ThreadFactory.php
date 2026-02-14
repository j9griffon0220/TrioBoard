<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // member不在デバッグ
        // dd('ThreadFactory called');

        return [
            // idとtimestampは自動生成されるので指定しない
            'title' => fake('ja_JP')->sentence(),
            // user_idは親から渡す
            // user_idを既存のUserモデルと紐付ける
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
