<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moduls extends Model
{
    use HasFactory;
    protected $table = 'moduls';
    protected $primaryKey = 'moduls_id';
    protected $fillable = [
        'moduls_code',
        'moduls_name',
        'moduls_icon',
        'moduls_created_at',
        'moduls_created_by',
        'moduls_updated_at',
        'moduls_updated_by',
        'moduls_deleted_at',
        'moduls_deleted_by',
        'moduls_notes',
        'moduls_soft_delete'
    ];
}
