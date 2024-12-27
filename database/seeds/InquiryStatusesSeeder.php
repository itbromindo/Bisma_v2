<?php

use App\Models\InquiryStatus;
use Illuminate\Database\Seeder;

class InquiryStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inquiryStatuses = [
            [
                'inquiry_status_code' => 'STATUS001',
                'inquiry_status_name' => 'Pending',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Status for pending inquiries',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS002',
                'inquiry_status_name' => 'In Progress',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Status for inquiries being processed',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS003',
                'inquiry_status_name' => 'Completed',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Status for completed inquiries',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS004',
                'inquiry_status_name' => 'Cancelled',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Status for cancelled inquiries',
                'inquiry_status_soft_delete' => false,
            ],
        ];

        InquiryStatus::insert($inquiryStatuses);
    }
}
