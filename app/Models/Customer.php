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
        'customers_created_at',
        'customers_created_by',
        'customers_updated_at',
        'customers_updated_by',
        'customers_deleted_at',
        'customers_deleted_by',
        'customers_notes',
        'customers_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
