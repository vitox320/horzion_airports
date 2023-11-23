<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Airport>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = City::factory()->create();
        return [
            'name' => "AEROPORTO DE $city->name",
            'airport_code' => mb_strtoupper($this->faker->unique()->lexify('???')),
            'city_id' => $city->id
        ];
    }
}
