<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryGood extends Model
{
    use HasFactory;

    protected $table = 'inquiry_goods_status';
    public $timestamps = false;
    protected $primaryKey = 'inquiry_goods_status_id';
    protected $fillable = [
        'inquiry_goods_status_code',
        'inquiry_goods_status_name',
        'inquiry_goods_status_created_at',
        'inquiry_goods_status_created_by',
        'inquiry_goods_status_updated_at',
        'inquiry_goods_status_updated_by',
        'inquiry_goods_status_deleted_at',
        'inquiry_goods_status_deleted_by',
        'inquiry_goods_status_notes',
        'inquiry_goods_status_soft_delete'
    ];
}
