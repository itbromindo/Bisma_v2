<?php

use App\Models\Department;
use App\Models\Division;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'department_code' => 'Dept001',
                'division_code' => 'D001',
                'department_name' => 'IT Dev',
                'department_created_at' => now(),
                'department_created_by' => 'admin',
                'department_updated_at' => now(),
                'department_updated_by' => 'admin',
                'department_deleted_at' => null,
                'department_deleted_by' => null,
                'department_notes' => 'Human Resources Department',
                'department_soft_delete' => 0,
            ],
            [
                'department_code' => 'Dept002',
                'division_code' => 'D002', 
                'department_name' => 'IT Support',
                'department_created_at' => now(),
                'department_created_by' => 'admin',
                'department_updated_at' => now(),
                'department_updated_by' => 'admin',
                'department_deleted_at' => null,
                'department_deleted_by' => null,
                'department_notes' => 'Finance and Accounting Department',
                'department_soft_delete' => 0,
            ],
      
        ];

        Department::insert($departments);
    }
}
