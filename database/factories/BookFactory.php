<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'release_date' => fake()->year(),
            'cover_path' => fake()->imageUrl(),
            'language' => 'Estonian',
            'summary' => fake()->sentence(20),
            'price' => fake()->randomFloat(1, 100),
            'stock_saldo' => fake()->randomNumber(),
            'pages' => fake()->randomNumber(),
            'type' => 'New'
        ];
    }
}
