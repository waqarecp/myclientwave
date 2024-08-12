<?php

namespace Database\Seeders;

use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
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
                'status_name'           => 'Fresh',
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Site Survey',
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Engineering Design',
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Proposal',
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'System Details Finalized',
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'PO Received',
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Cold',
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Fresh',
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Site Survey',
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Engineering Design',
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Proposal',
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'System Details Finalized',
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'PO Received',
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Cold',
            ],
        ];


        foreach ($data as $row) {
            LeadStatus::create($row);
        }
    }
}
