<?php

use App\Models\TemplateWinLose;
use Illuminate\Database\Seeder;

class TemplateWinLosesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $templateWinLoses = [
            [
                'template_win_loses_code' => 'TWL001',
                'template_win_loses_title' => 'Win Template 1',
                'template_win_loses_text' => 'Congratulations, you have won!',
                'template_win_loses_notes' => 'Note for Win Template 1',
                'template_win_loses_created_at' => now(),
                'template_win_loses_created_by' => 'admin',
                'template_win_loses_updated_at' => null,
                'template_win_loses_updated_by' => null,
                'template_win_loses_deleted_at' => null,
                'template_win_loses_deleted_by' => null,
                'template_win_loses_soft_delete' => false,
            ],
            [
                'template_win_loses_code' => 'TWL002',
                'template_win_loses_title' => 'Lose Template 1',
                'template_win_loses_text' => 'Unfortunately, you did not win.',
                'template_win_loses_notes' => 'Note for Lose Template 1',
                'template_win_loses_created_at' => now(),
                'template_win_loses_created_by' => 'admin',
                'template_win_loses_updated_at' => null,
                'template_win_loses_updated_by' => null,
                'template_win_loses_deleted_at' => null,
                'template_win_loses_deleted_by' => null,
                'template_win_loses_soft_delete' => false,
            ],
            [
                'template_win_loses_code' => 'TWL003',
                'template_win_loses_title' => 'Draw Template',
                'template_win_loses_text' => 'The game ended in a draw.',
                'template_win_loses_notes' => 'Note for Draw Template',
                'template_win_loses_created_at' => now(),
                'template_win_loses_created_by' => 'admin',
                'template_win_loses_updated_at' => null,
                'template_win_loses_updated_by' => null,
                'template_win_loses_deleted_at' => null,
                'template_win_loses_deleted_by' => null,
                'template_win_loses_soft_delete' => false,
            ],
        ];

        TemplateWinLose::insert($templateWinLoses);
    }
}
