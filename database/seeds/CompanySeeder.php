<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'companies_code' => 'C001',
                'companies_name' => 'Company A',
                'companies_created_at' => now(),
                'companies_created_by' => 'admin',
                'companies_updated_at' => now(),
                'companies_updated_by' => 'admin',
                'companies_deleted_at' => null,
                'companies_deleted_by' => null,
                'companies_notes' => 'Company A Notes',
                'companies_soft_delete' => 0,
            ],
            [
                'companies_code' => 'C002',
                'companies_name' => 'Company B',
                'companies_created_at' => now(),
                'companies_created_by' => 'admin',
                'companies_updated_at' => now(),
                'companies_updated_by' => 'admin',
                'companies_deleted_at' => null,
                'companies_deleted_by' => null,
                'companies_notes' => 'Company B Notes',
                'companies_soft_delete' => 0,
            ],
        ];

        Company::insert($companies);
    }
}
