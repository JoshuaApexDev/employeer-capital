<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    public function run()
    {
        $document_types = [
            [
                'id' => 1,
                'name' => 'PPP Amount received and the terms',
                'description' => 'PPP Amount received and the terms',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 2,
                'name' => 'IRS Form',
                'description' => 'IRS Form 941 for 2020 and 2021s',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 3,
                'name' => 'Name of the owners',
                'description' => 'Name of the owners (Shareholders)',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ],
            [
                'id' => 4,
                'name' => 'Unemployment Tax and Wage Report',
                'description' => 'Arizona Department of Economic Security - Unemployment Tax and Wage Report (UC-018) 2020, 2021 or your Quarterly Payroll Summary',
                'created_at' => '2021-04-26 22:37:11',
                'updated_at' => '2021-04-26 22:37:11',
            ]
        ];

        DocumentType::insert($document_types);
    }
}
