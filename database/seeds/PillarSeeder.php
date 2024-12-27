<?php

use App\Models\Pillar;
use Illuminate\Database\Seeder;

class PillarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pillars = [
            ['pillar_code' => '1001', 'pillar_items' => 'Pillar 1', 'pillar_notes' => 'Note for Pillar 1'],
            ['pillar_code' => '1002', 'pillar_items' => 'Pillar 2', 'pillar_notes' => 'Note for Pillar 2'],
            ['pillar_code' => '1003', 'pillar_items' => 'Pillar 3', 'pillar_notes' => 'Note for Pillar 3'],
            ['pillar_code' => '1004', 'pillar_items' => 'Pillar 4', 'pillar_notes' => 'Note for Pillar 4'],
            ['pillar_code' => '1005', 'pillar_items' => 'Pillar 5', 'pillar_notes' => 'Note for Pillar 5'],
        ];

        Pillar::insert($pillars);
    }
}
