<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_code',
        'customer_name',
        'customers_existing',
        'customers_full_address',
        'customers_phone',
        'customers_email',
        'customers_PIC',
        'customers_npwp',
        'customers_village',
        'districts_code',
        'cities_code',
        'provinces_code',
        'customers_category',
        'customers_area',
        'customer_created_at',
        'customer_created_by',
        'customer_updated_at',
        'customer_updated_by',
        'customer_deleted_at',
        'customer_deleted_by',
        'customer_notes',
        'customer_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
