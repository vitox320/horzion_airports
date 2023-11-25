<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passenger>
 */
class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return \Faker\Generator
     */

    protected function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->unique()->cpf,
            'email' => $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->date()
        ];
    }
}
