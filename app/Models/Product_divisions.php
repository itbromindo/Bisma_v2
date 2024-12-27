<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_divisions extends Model
{
    use HasFactory;
    protected $table = 'product_divisions';
    protected $primaryKey = 'product_divisions_id';
    protected $fillable = [
        'product_divisions_code',
        'product_divisions_name',
        'product_divisions_created_at',
        'product_divisions_created_by',
        'product_divisions_updated_at',
        'product_divisions_updated_by',
        'product_divisions_deleted_at',
        'product_divisions_deleted_by',
        'product_divisions_notes',
        'product_divisions_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
