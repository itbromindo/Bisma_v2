<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'brand_code',
        'brand_name',
        'brand_created_at',
        'brand_created_by',
        'brand_updated_at',
        'brand_updated_by',
        'brand_deleted_at',
        'brand_deleted_by',
        'brand_notes',
        'brand_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
