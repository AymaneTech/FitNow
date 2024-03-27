<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => 1,
            "height" => $this->faker->numberBetween(1, 100),
            "weight" => $this->faker->numberBetween(1, 100),
            "performance" => json_encode([
                'performance_field1' => $this->faker->word,
                'performance_field2' => $this->faker->word,
            ]),
            "measurements" => json_encode([
                'measurement_field1' => $this->faker->word,
                'measurement_field2' => $this->faker->word,
            ]),
        ];
    }
}
