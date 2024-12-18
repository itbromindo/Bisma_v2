<?php

use App\Models\DescriptionQuotation;
use Illuminate\Database\Seeder;

class DescriptionQuotationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descriptionQuotations = [
            [
                'template_inquiry_desc_code' => 'DESC001',
                'template_inquiry_desc_title' => 'Quotation for Basic Package',
                'template_inquiry_desc_text' => 'This quotation is for the basic package including standard features.',
                'template_inquiry_desc_created_at' => now(),
                'template_inquiry_desc_created_by' => 'admin',
                'template_inquiry_desc_updated_at' => null,
                'template_inquiry_desc_updated_by' => null,
                'template_inquiry_desc_deleted_at' => null,
                'template_inquiry_desc_deleted_by' => null,
                'template_inquiry_desc_notes' => 'Description for basic package quotation',
                'template_inquiry_desc_soft_delete' => false,
            ],
            [
                'template_inquiry_desc_code' => 'DESC002',
                'template_inquiry_desc_title' => 'Quotation for Premium Package',
                'template_inquiry_desc_text' => 'This quotation is for the premium package including advanced features.',
                'template_inquiry_desc_created_at' => now(),
                'template_inquiry_desc_created_by' => 'admin',
                'template_inquiry_desc_updated_at' => null,
                'template_inquiry_desc_updated_by' => null,
                'template_inquiry_desc_deleted_at' => null,
                'template_inquiry_desc_deleted_by' => null,
                'template_inquiry_desc_notes' => 'Description for premium package quotation',
                'template_inquiry_desc_soft_delete' => false,
            ],
            [
                'template_inquiry_desc_code' => 'DESC003',
                'template_inquiry_desc_title' => 'Quotation for Enterprise Package',
                'template_inquiry_desc_text' => 'This quotation is for the enterprise package including all features.',
                'template_inquiry_desc_created_at' => now(),
                'template_inquiry_desc_created_by' => 'admin',
                'template_inquiry_desc_updated_at' => null,
                'template_inquiry_desc_updated_by' => null,
                'template_inquiry_desc_deleted_at' => null,
                'template_inquiry_desc_deleted_by' => null,
                'template_inquiry_desc_notes' => 'Description for enterprise package quotation',
                'template_inquiry_desc_soft_delete' => false,
            ],
        ];

        DescriptionQuotation::insert($descriptionQuotations);
    }
}
