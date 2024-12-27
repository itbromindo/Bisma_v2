<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;
    protected $table = 'goods';
    protected $primaryKey = 'goods_id';
    protected $fillable = [
        'goods_code',
        'goods_name',
        'goods_photo',
        'goods_usage',
        'goods_specification',
        'brand_code',
        'goods_price',
        'goods_stock',
        'goods_end_user_margin',
        'goods_contractor_margin',
        'goods_reseller_margin',
        'goods_pricelist_margon',
        'goods_end_user_price',
        'goods_contractor_price',
        'goods_reseller_price',
        'goods_pricelist_price',
        'uom_code',
        'goods_weight',
        'product_division_code',
        'product_category_code',
        'goods_availability',
        'goods_created_at',
        'goods_created_by',
        'goods_updated_at',
        'goods_updated_by',
        'goods_deleted_at',
        'goods_deleted_by',
        'goods_notes',
        'goods_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
