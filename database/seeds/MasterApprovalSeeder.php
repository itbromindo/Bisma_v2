<?php

use App\Models\MasterApproval;
use App\Models\Department;
use App\Models\Division;
use App\Models\Levels;
use Illuminate\Database\Seeder;

class MasterApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masterApprovals = [
            [
                'master_approvals_code' => 'MA001',
                'master_approvals_name' => 'Approval A',
                'department_code' => 'Dept001', 
                'division_code' => 'D001', 
                'level_code' => 'L001',
                'master_approvals_created_at' => now(),
                'master_approvals_created_by' => 'admin',
                'master_approvals_updated_at' => now(),
                'master_approvals_updated_by' => 'admin',
                'master_approvals_deleted_at' => null,
                'master_approvals_deleted_by' => null,
                'master_approvals_notes' => 'Master approval A notes',
                'master_approvals_soft_delete' => 0,
            ],
            [
                'master_approvals_code' => 'MA002',
                'master_approvals_name' => 'Approval B',
                'department_code' => 'Dept002', 
                'division_code' => 'D002', 
                'level_code' => 'L002', 
                'master_approvals_created_at' => now(),
                'master_approvals_created_by' => 'admin',
                'master_approvals_updated_at' => now(),
                'master_approvals_updated_by' => 'admin',
                'master_approvals_deleted_at' => null,
                'master_approvals_deleted_by' => null,
                'master_approvals_notes' => 'Master approval B notes',
                'master_approvals_soft_delete' => 0,
            ],
            
        ];

        MasterApproval::insert($masterApprovals);
    }
}
