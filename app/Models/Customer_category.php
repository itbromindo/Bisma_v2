<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_category extends Model
{
    use HasFactory;
    protected $table = 'customer_category';
    protected $primaryKey = 'customer_category_id';
    protected $fillable = [
        'customer_category_code',
        'customer_category_name',
        'customer_category_created_at',
        'customer_category_created_by',
        'customer_category_updated_at',
        'customer_category_updated_by',
        'customer_category_deleted_at',
        'customer_category_deleted_by',
        'customer_category_notes',
        'customer_category_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
