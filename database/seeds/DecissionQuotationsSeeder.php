<?php

use App\Models\DecissionQuotation;
use Illuminate\Database\Seeder;

class DecissionQuotationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $decissionQuotations = [
            [
                'template_decission_quotation_code' => 'DEC001',
                'template_decission_quotation_title' => 'Approve Quotation',
                'template_decission_quotation_text' => 'The quotation has been approved.',
                'template_decission_quotation_created_at' => now(),
                'template_decission_quotation_created_by' => 'admin',
                'template_decission_quotation_updated_at' => null,
                'template_decission_quotation_updated_by' => null,
                'template_decission_quotation_deleted_at' => null,
                'template_decission_quotation_deleted_by' => null,
                'template_decission_quotation_notes' => 'Approval of the quotation.',
                'template_decission_quotation_soft_delete' => false,
            ],
            [
                'template_decission_quotation_code' => 'DEC002',
                'template_decission_quotation_title' => 'Reject Quotation',
                'template_decission_quotation_text' => 'The quotation has been rejected.',
                'template_decission_quotation_created_at' => now(),
                'template_decission_quotation_created_by' => 'admin',
                'template_decission_quotation_updated_at' => null,
                'template_decission_quotation_updated_by' => null,
                'template_decission_quotation_deleted_at' => null,
                'template_decission_quotation_deleted_by' => null,
                'template_decission_quotation_notes' => 'Rejection of the quotation.',
                'template_decission_quotation_soft_delete' => false,
            ],
            [
                'template_decission_quotation_code' => 'DEC003',
                'template_decission_quotation_title' => 'Pending Review',
                'template_decission_quotation_text' => 'The quotation is pending review.',
                'template_decission_quotation_created_at' => now(),
                'template_decission_quotation_created_by' => 'admin',
                'template_decission_quotation_updated_at' => null,
                'template_decission_quotation_updated_by' => null,
                'template_decission_quotation_deleted_at' => null,
                'template_decission_quotation_deleted_by' => null,
                'template_decission_quotation_notes' => 'Quotation awaiting further review.',
                'template_decission_quotation_soft_delete' => false,
            ],
        ];

        DecissionQuotation::insert($decissionQuotations);
    }
}
