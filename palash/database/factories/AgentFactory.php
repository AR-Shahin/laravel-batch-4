<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "seller_id" => rand(1,8),
            "name" => $this->faker->name(),
            "email" => $this->faker->email(),
            "password" => bcrypt("password"),
            "phone" => $this->faker->phoneNumber(),
        ];
    }
}
