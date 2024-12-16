<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    use HasFactory;
    protected $table = 'uom';
    protected $primaryKey = 'uom_id';
    protected $fillable = [
        'uom_code',
        'uom_name',
        'uom_created_at',
        'uom_created_by',
        'uom_updated_at',
        'uom_updated_by',
        'uom_deleted_at',
        'uom_deleted_by',
        'uom_notes',
        'uom_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
