<?php

use App\Models\OptionChecklist;
use Illuminate\Database\Seeder;

class OptionChecklistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $optionChecklists = [
            [
                'option_checklist_code' => 'OPT001',
                'checklist_code' => 'CHK001',
                'option_checklist_items' => 'Option Item 1',
                'option_checklist_created_at' => now(),
                'option_checklist_created_by' => 'admin',
                'option_checklist_updated_at' => now(),
                'option_checklist_updated_by' => 'admin',
                'option_checklist_deleted_at' => null,
                'option_checklist_deleted_by' => null,
                'option_checklist_notes' => 'Note for Option Item 1',
                'option_checklist_soft_delete' => false,
            ],
            [
                'option_checklist_code' => 'OPT002',
                'checklist_code' => 'CHK002',
                'option_checklist_items' => 'Option Item 2',
                'option_checklist_created_at' => now(),
                'option_checklist_created_by' => 'admin',
                'option_checklist_updated_at' => now(),
                'option_checklist_updated_by' => 'admin',
                'option_checklist_deleted_at' => null,
                'option_checklist_deleted_by' => null,
                'option_checklist_notes' => 'Note for Option Item 2',
                'option_checklist_soft_delete' => false,
            ],
            [
                'option_checklist_code' => 'OPT003',
                'checklist_code' => 'CHK003',
                'option_checklist_items' => 'Option Item 3',
                'option_checklist_created_at' => now(),
                'option_checklist_created_by' => 'admin',
                'option_checklist_updated_at' => now(),
                'option_checklist_updated_by' => 'admin',
                'option_checklist_deleted_at' => null,
                'option_checklist_deleted_by' => null,
                'option_checklist_notes' => 'Note for Option Item 3',
                'option_checklist_soft_delete' => false,
            ],
            [
                'option_checklist_code' => 'OPT004',
                'checklist_code' => 'CHK004',
                'option_checklist_items' => 'Option Item 4',
                'option_checklist_created_at' => now(),
                'option_checklist_created_by' => 'admin',
                'option_checklist_updated_at' => now(),
                'option_checklist_updated_by' => 'admin',
                'option_checklist_deleted_at' => null,
                'option_checklist_deleted_by' => null,
                'option_checklist_notes' => 'Note for Option Item 4',
                'option_checklist_soft_delete' => false,
            ],
            [
                'option_checklist_code' => 'OPT005',
                'checklist_code' => 'CHK005',
                'option_checklist_items' => 'Option Item 5',
                'option_checklist_created_at' => now(),
                'option_checklist_created_by' => 'admin',
                'option_checklist_updated_at' => now(),
                'option_checklist_updated_by' => 'admin',
                'option_checklist_deleted_at' => null,
                'option_checklist_deleted_by' => null,
                'option_checklist_notes' => 'Note for Option Item 5',
                'option_checklist_soft_delete' => false,
            ],
        ];

        OptionChecklist::insert($optionChecklists);
    }
}
