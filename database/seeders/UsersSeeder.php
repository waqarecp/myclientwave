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
                'company_id'              => '1',
                'name'              => 'Yasel Corporan',
                'email'             => 'yasel@fusionsolarenergy.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ],
            [
                'company_id'              => '1',
                'name'              => 'Waqar Ahmad',
                'email'             => 'waqarecp1992@gmail.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ],
            [
                'company_id'              => '2',
                'name'              => 'Erick F',
                'email'             => 'erick@fusionsolarenergy.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ],
            [
                'company_id'              => '2',
                'name'              => 'Wesley GH',
                'email'             => 'wesley@fusionsolarenergy.com',
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ]
        ];


        foreach ($usersData as $userData) {
            $user = User::create($userData);
        }
    }
}
