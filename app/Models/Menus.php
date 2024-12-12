<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $primaryKey = 'menus_id';
    protected $fillable = [
        'menus_code',
        'moduls_code',
        'menus_name',
        'menus_route',
        'menus_created_at',
        'menus_created_by',
        'menus_updated_at',
        'menus_updated_by',
        'menus_deleted_at',
        'menus_deleted_by',
        'menus_notes',
        'menus_soft_delete'
    ];
}
