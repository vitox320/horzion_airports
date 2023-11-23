<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $states = [
            'BA',
            'SP',
            'MG'
        ];
        $faker = \Faker\Factory::create('pt_BR');
        return [
            'name' => $faker->city(),
            'uf' => $states[rand(0, 2)]
        ];
    }

    protected function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }
}
