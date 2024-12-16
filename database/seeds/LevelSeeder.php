<?php

use App\Models\Levels;
use App\Models\Department;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                'level_code' => 'L001',
                'department_code' => 'Dept001', 
                'level_name' => 'Level 1',
                'level_created_at' => now(),
                'level_created_by' => 'admin',
                'level_updated_at' => now(),
                'level_updated_by' => 'admin',
                'level_deleted_at' => null,
                'level_deleted_by' => null,
                'level_notes' => 'Level 1 Notes',
                'level_soft_delete' => 0,
            ],
            [
                'level_code' => 'L002',
                'department_code' => 'Dept002',
                'level_name' => 'Level 2',
                'level_created_at' => now(),
                'level_created_by' => 'admin',
                'level_updated_at' => now(),
                'level_updated_by' => 'admin',
                'level_deleted_at' => null,
                'level_deleted_by' => null,
                'level_notes' => 'Level 2 Notes',
                'level_soft_delete' => 0,
            ],
           
        ];

        Levels::insert($levels);
    }
}
