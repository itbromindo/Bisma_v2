<?php

use App\Models\Shift;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = [
            [
                'shift_code' => 'SI001',
                'companies_code' => 'CO001', 
                'shift_name' => 'Morning Shift',
                'shift_start_time_before_break' => '08:00:00',
                'shift_end_time_before_break' => '12:00:00',
                'shift_start_time_break' => '12:30:00',
                'shift_end_time_break' => '13:00:00',
                'shift_start_time_after_break' => '13:00:00',
                'shift_end_time_after_break' => '17:00:00',
                'shift_created_at' => now(),
                'shift_created_by' => 'admin',
                'shift_updated_at' => now(),
                'shift_updated_by' => 'admin',
                'shift_deleted_at' => null,
                'shift_deleted_by' => null,
                'shift_notes' => 'Morning shift schedule',
                'shift_soft_delete' => 0,
            ],
            [
                'shift_code' => 'SI002',
                'companies_code' => 'CO002', 
                'shift_name' => 'Night Shift',
                'shift_start_time_before_break' => '20:00:00',
                'shift_end_time_before_break' => '00:00:00',
                'shift_start_time_break' => '00:30:00',
                'shift_end_time_break' => '01:00:00',
                'shift_start_time_after_break' => '01:00:00',
                'shift_end_time_after_break' => '05:00:00',
                'shift_created_at' => now(),
                'shift_created_by' => 'admin',
                'shift_updated_at' => now(),
                'shift_updated_by' => 'admin',
                'shift_deleted_at' => null,
                'shift_deleted_by' => null,
                'shift_notes' => 'Night shift schedule',
                'shift_soft_delete' => 0,
            ],
         
        ];

        Shift::insert($shifts);
    }
}
