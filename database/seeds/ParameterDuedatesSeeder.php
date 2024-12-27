<?php

use App\Models\ParameterDuedate;
use Illuminate\Database\Seeder;

class ParameterDuedatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parameterDuedates = [
            [
                'param_duedate_code' => 'DUED001',
                'param_duedate_name' => 'Payment Due Date',
                'param_duedate_time' => '2024-01-15',
                'user_code' => 'admin1',
                'param_duedate_created_at' => now(),
                'param_duedate_created_by' => 'admin',
                'param_duedate_updated_at' => null,
                'param_duedate_updated_by' => null,
                'param_duedate_deleted_at' => null,
                'param_duedate_deleted_by' => null,
                'param_duedate_notes' => 'Payment due date for January invoices',
                'param_duedate_soft_delete' => false,
            ],
            [
                'param_duedate_code' => 'DUED002',
                'param_duedate_name' => 'Project Completion Due Date',
                'param_duedate_time' => '2024-02-28',
                'user_code' => 'admin1',
                'param_duedate_created_at' => now(),
                'param_duedate_created_by' => 'admin',
                'param_duedate_updated_at' => null,
                'param_duedate_updated_by' => null,
                'param_duedate_deleted_at' => null,
                'param_duedate_deleted_by' => null,
                'param_duedate_notes' => 'Completion due date for project X',
                'param_duedate_soft_delete' => false,
            ]
        ];

        ParameterDuedate::insert($parameterDuedates);
    }
}
