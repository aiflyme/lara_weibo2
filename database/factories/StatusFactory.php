<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data_time = $this->faker->date . ' ' . $this->faker->time;
        return [
            'content' => fake()->text(140),
            'user_id' => fake()->randomElement([1,2,3,]),//fake()->unique()->safeEmail(),
            'created_at' => $data_time,
            'updated_at' => $data_time,

        ];
    }
}
