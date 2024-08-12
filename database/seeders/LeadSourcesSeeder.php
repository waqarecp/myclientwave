<?php

namespace Database\Seeders;

use App\Models\LeadSource;
use Illuminate\Database\Seeder;

class LeadSourcesSeeder extends Seeder
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
                'source_name'           => 'FaceBook',
            ],
            [
                'company_id'           => '1',
                'source_name'           => 'Twitter',
            ],
            [
                'company_id'           => '2',
                'source_name'           => 'Instagram',
            ],
            [
                'company_id'           => '2',
                'source_name'           => 'Tiktok',
            ],
        ];


        foreach ($data as $row) {
            LeadSource::create($row);
        }
    }
}
