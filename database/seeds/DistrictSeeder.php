<?php

use App\Models\District;
use App\Models\City;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            [
                'districts_code' => 'DC001',
                'cities_code' => 'CI001', 
                'districts_name' => 'District A',
                'districts_created_at' => now(),
                'districts_created_by' => 'admin',
                'districts_updated_at' => now(),
                'districts_updated_by' => 'admin',
                'districts_deleted_at' => null,
                'districts_deleted_by' => null,
                'districts_notes' => 'Notes for District A',
                // 'districts_status' => 'Active',
                'districts_soft_delete' => 0,
            ],
            [
                'districts_code' => 'DC002',
                'cities_code' => 'CI002', 
                'districts_name' => 'District B',
                'districts_created_at' => now(),
                'districts_created_by' => 'admin',
                'districts_updated_at' => now(),
                'districts_updated_by' => 'admin',
                'districts_deleted_at' => null,
                'districts_deleted_by' => null,
                'districts_notes' => 'Notes for District B',
                // 'districts_status' => 'Active',
                'districts_soft_delete' => 0,
            ],
           
        ];

        District::insert($districts);
    }
}
