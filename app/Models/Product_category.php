<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    use HasFactory;
    protected $table = 'product_category';
    protected $primaryKey = 'product_category_id';
    protected $fillable = [
        'product_category_code',
        'product_category_name',
        'product_category_created_at',
        'product_category_created_by',
        'product_category_updated_at',
        'product_category_updated_by',
        'product_category_deleted_at',
        'product_category_deleted_by',
        'product_category_notes',
        'product_category_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
