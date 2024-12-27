<?php

use Illuminate\Database\Seeder;
use App\Models\QuotationStatus;

class QuotationStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quotationStatuses = [
            [
                'quotation_status_code' => 'STATUS001',
                'quotation_status_name' => 'Pending',
                'quotation_status_created_at' => now(),
                'quotation_status_created_by' => 'admin',
                'quotation_status_updated_at' => null,
                'quotation_status_updated_by' => null,
                'quotation_status_deleted_at' => null,
                'quotation_status_deleted_by' => null,
                'quotation_status_notes' => 'Status for pending quotations',
                'quotation_status_soft_delete' => false,
            ],
            [
                'quotation_status_code' => 'STATUS002',
                'quotation_status_name' => 'In Progress',
                'quotation_status_created_at' => now(),
                'quotation_status_created_by' => 'admin',
                'quotation_status_updated_at' => null,
                'quotation_status_updated_by' => null,
                'quotation_status_deleted_at' => null,
                'quotation_status_deleted_by' => null,
                'quotation_status_notes' => 'Status for quotations in progress',
                'quotation_status_soft_delete' => false,
            ],
            [
                'quotation_status_code' => 'STATUS003',
                'quotation_status_name' => 'Completed',
                'quotation_status_created_at' => now(),
                'quotation_status_created_by' => 'admin',
                'quotation_status_updated_at' => null,
                'quotation_status_updated_by' => null,
                'quotation_status_deleted_at' => null,
                'quotation_status_deleted_by' => null,
                'quotation_status_notes' => 'Status for completed quotations',
                'quotation_status_soft_delete' => false,
            ],
            [
                'quotation_status_code' => 'STATUS004',
                'quotation_status_name' => 'Cancelled',
                'quotation_status_created_at' => now(),
                'quotation_status_created_by' => 'admin',
                'quotation_status_updated_at' => null,
                'quotation_status_updated_by' => null,
                'quotation_status_deleted_at' => null,
                'quotation_status_deleted_by' => null,
                'quotation_status_notes' => 'Status for cancelled quotations',
                'quotation_status_soft_delete' => false,
            ],
        ];

        QuotationStatus::insert($quotationStatuses);
    }
}
