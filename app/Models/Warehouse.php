<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';
    protected $fillable = [
        'warehouse_code',
        'warehouse_name',
        'warehouse_created_at',
        'warehouse_created_by',
        'warehouse_updated_at',
        'warehouse_updated_by',
        'warehouse_deleted_at',
        'warehouse_deleted_by',
        'warehouse_notes',
        'warehouse_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
