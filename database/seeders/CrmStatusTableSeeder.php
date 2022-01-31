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
        ];

        CrmStatus::insert($crmStatuses);
    }
}
