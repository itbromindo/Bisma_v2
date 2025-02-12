<?php

use App\Models\Division;
use App\Models\Company;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            [
                'division_code' => 'DI001',
                'companies_code' => 'CO001',
                'division_name' => 'IT',
                'division_created_at' => now(),
                'division_created_by' => 'admin',
                'division_updated_at' => now(),
                'division_updated_by' => 'admin',
                'division_deleted_at' => null,
                'division_deleted_by' => null,
                'division_notes' => 'Division A Notes',
                'division_soft_delete' => 0,
            ],
            [
                'division_code' => 'DI002',
                'companies_code' => 'CO002', 
                'division_name' => 'Sales',
                'division_created_at' => now(),
                'division_created_by' => 'admin',
                'division_updated_at' => now(),
                'division_updated_by' => 'admin',
                'division_deleted_at' => null,
                'division_deleted_by' => null,
                'division_notes' => 'Division B Notes',
                'division_soft_delete' => 0,
            ],
            
        ];

        Division::insert($divisions);
    }
}
