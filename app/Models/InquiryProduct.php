<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InquiryProduct extends Model
{
    use HasFactory;
    protected $table = 'inquiry_product';
    protected $primaryKey = 'inquiry_product_id';
    protected $fillable = [
        'inquiry_product_code',
        'inquiry_code',
        'goods_code',
        'inquiry_product_name',
        'inquiry_product_status_quote_no_quote',
        'inquiry_product_qty',
        'inquiry_product_status_on_inquiry',
        'inquiry_product_uom',
        'inquiry_product_cost_of_goods',
        'inquiry_product_pricelist',
        'inquiry_product_net_price',
        'inquiry_taxes_percent',
        'inquiry_taxes_nominal',
        'inquiry_product_total_price',
        'inquiry_product_reason_no_quote',
    ];
}
