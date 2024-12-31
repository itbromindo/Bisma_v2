<?php

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'cities_code' => 'CI001',
                'provinces_code' => 'PV001', 
                'cities_name' => 'City A',
                'cities_created_at' => now(),
                'cities_created_by' => 'admin',
                'cities_updated_at' => now(),
                'cities_updated_by' => 'admin',
                'cities_deleted_at' => null,
                'cities_deleted_by' => null,
                'cities_notes' => 'Notes for City A',
                // 'cities_status' => 'Active',
                'cities_soft_delete' => 0,
            ],
            [
                'cities_code' => 'CI002',
                'provinces_code' => 'PV002', 
                'cities_name' => 'City B',
                'cities_created_at' => now(),
                'cities_created_by' => 'admin',
                'cities_updated_at' => now(),
                'cities_updated_by' => 'admin',
                'cities_deleted_at' => null,
                'cities_deleted_by' => null,
                'cities_notes' => 'Notes for City B',
                // 'cities_status' => 'Active',
                'cities_soft_delete' => 0,
            ],
            
        ];

        City::insert($cities);
    }
}
