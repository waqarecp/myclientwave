<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $usersData = [
            [
                'name'              => 'Yasel Corporan',
                'email'             => 'yasel@fusionsolarenergy.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Waqar Ahmad',
                'email'             => 'waqarecp1992@gmail.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Erick F',
                'email'             => 'erick@fusionsolarenergy.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ]
        ];


        foreach ($usersData as $userData) {
            $user = User::create($userData);
        }
    }
}
