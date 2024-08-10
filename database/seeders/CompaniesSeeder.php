<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'           => 'Fusion Solar Energy',
                'email'          => 'info@fusionsolarenergy.com',
                'phone'          => '0210011919',
                'logo'           => 'default.png', 
                'website'        => 'www.fusionsolarenergy.com',
                'address'        => 'Test company address',
            ]
        ];


        foreach ($data as $row) {
            Company::create($row);
        }
    }
}
