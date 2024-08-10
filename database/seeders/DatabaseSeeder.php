<?php

namespace Database\Seeders;

use App\Models\AnalyticsApp;
use App\Models\Provider;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompaniesSeeder::class,
            UsersSeeder::class,
            RolesPermissionsSeeder::class
        ]);

        // \App\Models\User::factory(20)->create();

        Address::factory(10)->create();


        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
