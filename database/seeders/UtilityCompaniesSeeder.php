<?php

namespace Database\Seeders;

use App\Models\UtilityCompany;
use Illuminate\Database\Seeder;

class UtilityCompaniesSeeder extends Seeder
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
                'company_id'           => '1',
                'utility_company_name' => 'PPL',
            ],
            [
                'company_id'           => '1',
                'utility_company_name' => 'ALP',
            ],
            [
                'company_id'           => '2',
                'utility_company_name' => 'LGP',
            ],
            [
                'company_id'           => '2',
                'utility_company_name' => 'GPA',
            ],
        ];


        foreach ($data as $row) {
            UtilityCompany::create($row);
        }
    }
}
