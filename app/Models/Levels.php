<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    use HasFactory;
    protected $table = 'level';
    protected $primaryKey = 'level_id';
    protected $fillable = [
        'level_code',
        'department_code',
        'level_name',
        'level_created_at',
        'level_created_by',
        'level_updated_at',
        'level_updated_by',
        'level_deleted_at',
        'level_deleted_by',
        'level_notes',
        'level_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
    
}
