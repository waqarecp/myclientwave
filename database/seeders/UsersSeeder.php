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
                'email'             => 'yasel@gmail.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Waqar Ahmad',
                'email'             => 'waqar@gmail.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Syed Khan',
                'email'             => 'sayrd@gmail.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ]
        ];


        foreach ($usersData as $userData) {
            $user = User::create($userData);
        }
    }
}
