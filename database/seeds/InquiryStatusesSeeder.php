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
                'inquiry_status_name' => 'Inquiry Masuk',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Inquiry Masuk, menampung inquiry yang dibuat baik secara manual maupun melalui final',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS002',
                'inquiry_status_name' => 'On Call Price',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Waiting list admin, menampung inquiry yang bergeser dari inquiry masuk ke on call price.',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS003',
                'inquiry_status_name' => 'Waiting Approval On Call Price',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Waiting list estimator, menampung inquiry project yang membutuhkan estimator',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS004',
                'inquiry_status_name' => 'Estimasi Project',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Waiting approval harga, menampung inquiry yang bergeser dari on call price ke approval. Jika sudah disetujui maka akan hilang dari list',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS005',
                'inquiry_status_name' => 'Waiting Approval Estimasi Project',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Reject, memuat inquiry yang ter reject',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS006',
                'inquiry_status_name' => 'Waiting Approval Inquiry No Quote',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Waiting Approval No Quote, memuat inquiry yang no quote  dan butuh persetujuan terlebih dahulu',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS007',
                'inquiry_status_name' => 'Inquiry No Quote',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Inquiry No Quote, memuat inquiry yang no quote dan sudah disetujui',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS008',
                'inquiry_status_name' => 'Waiting Approval No Batal',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Waiting Approval Batal, memuat inquiry yang dan butuh persetujuan terlebih dahulu',
                'inquiry_status_soft_delete' => false,
            ],
            [
                'inquiry_status_code' => 'STATUS009',
                'inquiry_status_name' => 'Inquiry Batal',
                'inquiry_status_created_at' => now(),
                'inquiry_status_created_by' => 'admin',
                'inquiry_status_updated_at' => null,
                'inquiry_status_updated_by' => null,
                'inquiry_status_deleted_at' => null,
                'inquiry_status_deleted_by' => null,
                'inquiry_status_notes' => 'Inquiry Batal, memuat inquiry yang batal dan sudah disetujui',
                'inquiry_status_soft_delete' => false,
            ],
        ];

        InquiryStatus::insert($inquiryStatuses);
    }
}
