<?php

namespace Database\Seeders;

use App\Models\Status;
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
                'color_code'            => '#58d07c'
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Site Survey',
                'color_code'            => '#86418b'
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Engineering Design',
                'color_code'            => '#3551c0'
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Proposal',
                'color_code'            => '#c819b9'
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'System Details Finalized',
                'color_code'            => '#abec32'
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'PO Received',
                'color_code'            => '#0ecacd'
            ],
            [
                'company_id'           => '1',
                'status_name'           => 'Cold',
                'color_code'            => '#dfb762'
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Fresh',
                'color_code'            => '#58d07c'
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Site Survey',
                'color_code'            => '#86418b'
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Engineering Design',
                'color_code'            => '#3551c0'
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Proposal',
                'color_code'            => '#c819b9'
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'System Details Finalized',
                'color_code'            => '#abec32'
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'PO Received',
                'color_code'            => '#0ecacd'
            ],
            [
                'company_id'           => '2',
                'status_name'           => 'Cold',
                'color_code'            => '#dfb762'
            ],
        ];


        foreach ($data as $row) {
            Status::create($row);
        }
    }
}
