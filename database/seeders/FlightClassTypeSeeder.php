<?php

namespace Database\Seeders;

use App\Models\FlightClassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flightClassTypes = [
            [
                'name' => 'Classe econômica'
            ],
            [
                'name' => 'Classe executiva'
            ],
            [
                'name' => 'Primeira classe'
            ],
        ];

        FlightClassType::insert($flightClassTypes);
    }
}
