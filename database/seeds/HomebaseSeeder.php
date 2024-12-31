<?php

use App\Models\Homebase;
use App\Models\Company;
use Illuminate\Database\Seeder;

class HomebaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homebases = [
            [
                'homebase_code' => 'HB001',
                'companies_code' => 'CO001', 
                'homebase_name' => 'Homebase A',
                'homebase_created_at' => now(),
                'homebase_created_by' => 'admin',
                'homebase_updated_at' => now(),
                'homebase_updated_by' => 'admin',
                'homebase_deleted_at' => null,
                'homebase_deleted_by' => null,
                'homebase_notes' => 'Homebase A Notes',
                'homebase_soft_delete' => 0,
            ],
            [
                'homebase_code' => 'HB002',
                'companies_code' => 'CO002',
                'homebase_name' => 'Homebase B',
                'homebase_created_at' => now(),
                'homebase_created_by' => 'admin',
                'homebase_updated_at' => now(),
                'homebase_updated_by' => 'admin',
                'homebase_deleted_at' => null,
                'homebase_deleted_by' => null,
                'homebase_notes' => 'Homebase B Notes',
                'homebase_soft_delete' => 0,
            ],
   
        ];

        Homebase::insert($homebases);
    }
}
