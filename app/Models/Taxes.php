<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
    use HasFactory;

    protected $primaryKey = 'taxes_id'; // Primary key
    protected $table = 'taxes'; // Table name

    public $timestamps = false; // Disable default timestamps

    protected $fillable = [
        'taxes_id',
        'taxes_code', 
        'taxes_name',
        'taxes_created_at',
        'taxes_created_by',
        'taxes_updated_at',
        'taxes_updated_by',
        'taxes_deleted_at',
        'taxes_deleted_by',
        'taxes_notes',
        'taxes_soft_delete',
    ];
}
