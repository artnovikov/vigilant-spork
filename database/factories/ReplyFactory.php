<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
use \App\Models\Review;
use \App\Models\Reply;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    protected $model = Reply::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->paragraph(),
            'review_id' => Review::factory(),
            'user_id' => User::factory()->create(['is_admin' => 1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
