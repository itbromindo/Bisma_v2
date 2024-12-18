<?php

use App\Models\OriginInquiry;
use Illuminate\Database\Seeder;

class OriginInquiriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $originInquiries = [
            [
                'origin_inquiry_code' => 'ORIGIN001',
                'origin_inquiry_name' => 'Website',
                'origin_inquiry_created_at' => now(),
                'origin_inquiry_created_by' => 'admin',
                'origin_inquiry_updated_at' => null,
                'origin_inquiry_updated_by' => null,
                'origin_inquiry_deleted_at' => null,
                'origin_inquiry_deleted_by' => null,
                'origin_inquiry_notes' => 'Inquiry originated from the website',
                'origin_inquiry_soft_delete' => false,
            ],
            [
                'origin_inquiry_code' => 'ORIGIN002',
                'origin_inquiry_name' => 'Email',
                'origin_inquiry_created_at' => now(),
                'origin_inquiry_created_by' => 'admin',
                'origin_inquiry_updated_at' => null,
                'origin_inquiry_updated_by' => null,
                'origin_inquiry_deleted_at' => null,
                'origin_inquiry_deleted_by' => null,
                'origin_inquiry_notes' => 'Inquiry originated from email communication',
                'origin_inquiry_soft_delete' => false,
            ],
            [
                'origin_inquiry_code' => 'ORIGIN003',
                'origin_inquiry_name' => 'Phone Call',
                'origin_inquiry_created_at' => now(),
                'origin_inquiry_created_by' => 'admin',
                'origin_inquiry_updated_at' => null,
                'origin_inquiry_updated_by' => null,
                'origin_inquiry_deleted_at' => null,
                'origin_inquiry_deleted_by' => null,
                'origin_inquiry_notes' => 'Inquiry originated from a phone call',
                'origin_inquiry_soft_delete' => false,
            ],
            [
                'origin_inquiry_code' => 'ORIGIN004',
                'origin_inquiry_name' => 'Social Media',
                'origin_inquiry_created_at' => now(),
                'origin_inquiry_created_by' => 'admin',
                'origin_inquiry_updated_at' => null,
                'origin_inquiry_updated_by' => null,
                'origin_inquiry_deleted_at' => null,
                'origin_inquiry_deleted_by' => null,
                'origin_inquiry_notes' => 'Inquiry originated from social media platforms',
                'origin_inquiry_soft_delete' => false,
            ],
        ];

        OriginInquiry::insert($originInquiries);
    }
}
