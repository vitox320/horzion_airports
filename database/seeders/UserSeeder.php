<?php

namespace Database\Seeders;

use App\Models\User;
use App\ValueObjects\Email;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Gestor1',
                'email' => (string)new Email('gestor1@gmail.com'),
                'password' => Hash::make('123456'),
                'profile_id' => 1
            ],
            [
                'name' => 'Gestor2',
                'email' => (string)new Email('gestor2@gmail.com'),
                'password' => Hash::make('123456'),
                'profile_id' => 1
            ]
        ];
        User::insert($users);
    }
}
