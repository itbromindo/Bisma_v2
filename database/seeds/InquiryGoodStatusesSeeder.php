<?php

use App\Models\InquiryGood;
use Illuminate\Database\Seeder;

class InquiryGoodsStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inquiryGoodsStatuses = [
            [
                'inquiry_goods_status_code' => 'IG001',
                'inquiry_goods_status_name' => 'Available',
                'inquiry_goods_status_created_at' => now(),
                'inquiry_goods_status_created_by' => 'admin',
                'inquiry_goods_status_updated_at' => null,
                'inquiry_goods_status_updated_by' => null,
                'inquiry_goods_status_deleted_at' => null,
                'inquiry_goods_status_deleted_by' => null,
                'inquiry_goods_status_notes' => 'Status for goods that are available',
                'inquiry_goods_status_soft_delete' => false,
            ],
            [
                'inquiry_goods_status_code' => 'IG002',
                'inquiry_goods_status_name' => 'Out of Stock',
                'inquiry_goods_status_created_at' => now(),
                'inquiry_goods_status_created_by' => 'admin',
                'inquiry_goods_status_updated_at' => null,
                'inquiry_goods_status_updated_by' => null,
                'inquiry_goods_status_deleted_at' => null,
                'inquiry_goods_status_deleted_by' => null,
                'inquiry_goods_status_notes' => 'Status for goods that are out of stock',
                'inquiry_goods_status_soft_delete' => false,
            ],
            [
                'inquiry_goods_status_code' => 'IG003',
                'inquiry_goods_status_name' => 'Discontinued',
                'inquiry_goods_status_created_at' => now(),
                'inquiry_goods_status_created_by' => 'admin',
                'inquiry_goods_status_updated_at' => null,
                'inquiry_goods_status_updated_by' => null,
                'inquiry_goods_status_deleted_at' => null,
                'inquiry_goods_status_deleted_by' => null,
                'inquiry_goods_status_notes' => 'Status for goods that are discontinued',
                'inquiry_goods_status_soft_delete' => false,
            ],
        ];

        InquiryGood::insert($inquiryGoodsStatuses);
    }
}
