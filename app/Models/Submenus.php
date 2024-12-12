<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenus extends Model
{
    use HasFactory;
    protected $table = 'submenus';
    protected $primaryKey = 'submenus_id';
    protected $fillable = [
        'submenus_code',
        'menus_code',
        'submenus_name',
        'submenus_created_at',
        'submenus_created_by',
        'submenus_updated_at',
        'submenus_updated_by',
        'submenus_deleted_at',
        'submenus_deleted_by',
        'submenus_notes',
        'submenus_soft_delete'
    ];
}
