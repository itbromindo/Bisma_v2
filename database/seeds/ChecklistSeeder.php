<?php

use App\Models\Checklist;
use Illuminate\Database\Seeder;

class ChecklistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checklists = [
            [
                'checklist_code' => 'CHK001',
                'pillar_code' => '1001', 
                'checklist_items' => 'Checklist Item 1',
                'checklist_created_at' => now(),
                'checklist_created_by' => 'admin',
                'checklist_updated_at' => now(),
                'checklist_updated_by' => 'admin',
                'checklist_deleted_at' => null,
                'checklist_deleted_by' => null,
                'checklist_notes' => 'Note for Checklist Item 1',
                'checklist_soft_delete' => false,
            ],
            [
                'checklist_code' => 'CHK002',
                'pillar_code' => '1002',
                'checklist_items' => 'Checklist Item 2',
                'checklist_created_at' => now(),
                'checklist_created_by' => 'admin',
                'checklist_updated_at' => now(),
                'checklist_updated_by' => 'admin',
                'checklist_deleted_at' => null,
                'checklist_deleted_by' => null,
                'checklist_notes' => 'Note for Checklist Item 2',
                'checklist_soft_delete' => false,
            ],
            [
                'checklist_code' => 'CHK003',
                'pillar_code' => '1003',
                'checklist_items' => 'Checklist Item 3',
                'checklist_created_at' => now(),
                'checklist_created_by' => 'admin',
                'checklist_updated_at' => now(),
                'checklist_updated_by' => 'admin',
                'checklist_deleted_at' => null,
                'checklist_deleted_by' => null,
                'checklist_notes' => 'Note for Checklist Item 3',
                'checklist_soft_delete' => false,
            ],
            [
                'checklist_code' => 'CHK004',
                'pillar_code' => '1004',
                'checklist_items' => 'Checklist Item 4',
                'checklist_created_at' => now(),
                'checklist_created_by' => 'admin',
                'checklist_updated_at' => now(),
                'checklist_updated_by' => 'admin',
                'checklist_deleted_at' => null,
                'checklist_deleted_by' => null,
                'checklist_notes' => 'Note for Checklist Item 4',
                'checklist_soft_delete' => false,
            ],
            [
                'checklist_code' => 'CHK005',
                'pillar_code' => '1005',
                'checklist_items' => 'Checklist Item 5',
                'checklist_created_at' => now(),
                'checklist_created_by' => 'admin',
                'checklist_updated_at' => now(),
                'checklist_updated_by' => 'admin',
                'checklist_deleted_at' => null,
                'checklist_deleted_by' => null,
                'checklist_notes' => 'Note for Checklist Item 5',
                'checklist_soft_delete' => false,
            ],
        ];

        Checklist::insert($checklists);
    }
}
