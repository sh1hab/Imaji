<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'keyword' => $this->faker->word,
            'status' => ['pending', 'completed', 'failed'][rand(0, 2)],
            'path' => $this->faker->imageUrl(),
        ];
    }
}
