<?php

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            [
                'provinces_code' => 'P001',
                'provinces_name' => 'Province A',
                'provinces_created_at' => now(),
                'provinces_created_by' => 'admin',
                'provinces_updated_at' => now(),
                'provinces_updated_by' => 'admin',
                'provinces_deleted_at' => null,
                'provinces_deleted_by' => null,
                'provinces_notes' => 'Notes for Province A',
                'provinces_status' => 1,
                'provinces_soft_delete' => 0,
            ],
            [
                'provinces_code' => 'P002',
                'provinces_name' => 'Province B',
                'provinces_created_at' => now(),
                'provinces_created_by' => 'admin',
                'provinces_updated_at' => now(),
                'provinces_updated_by' => 'admin',
                'provinces_deleted_at' => null,
                'provinces_deleted_by' => null,
                'provinces_notes' => 'Notes for Province B',
                'provinces_status' => 1,
                'provinces_soft_delete' => 0,
            ],
            
        ];

        Province::insert($provinces);
    }
}
