<?php

namespace Database\Seeders;

use App\Models\CrmStatus;
use Illuminate\Database\Seeder;

class CrmStatusTableSeeder extends Seeder
{
    public function run()
    {
        $crmStatuses = [
            [
                'id'         => 1,
                'name'       => 'Lead',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id'         => 2,
                'name'       => 'Customer',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id'         => 3,
                'name'       => 'Partner',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 4,
                'name' => 'New Lead',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 5,
                'name' => 'Not Interested',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 6,
                'name' => "Doesn't Qualify",
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 7,
                'name' => 'Stips Requested',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 8,
                'name' => 'Stips Received',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 9,
                'name' => 'Contract Out',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 10,
                'name' => 'Contract In',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 11,
                'name' => 'File Submitted to IRS for Refund',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 12,
                'name' => 'Canceled',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 13,
                'name' => 'After File Submitted Tax Resolution Plus for Analysis',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 14,
                'name' => 'ERC Approved',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 15,
                'name' => 'Client Paid',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 16,
                'name' => 'ERC Advance',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],

        ];

        CrmStatus::insert($crmStatuses);
    }
}
