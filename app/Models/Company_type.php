<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_type extends Model
{
    use HasFactory;
    protected $table = 'company_type';
    protected $primaryKey = 'company_type_id';
    protected $fillable = [
        'company_type_code',
        'company_type_name',
        'company_type_created_at',
        'company_type_created_by',
        'company_type_updated_at',
        'company_type_updated_by',
        'company_type_deleted_at',
        'company_type_deleted_by',
        'company_type_notes',
        'company_type_soft_delete'
    ];

    public $timestamps = true;
    public $companystamps = false;
}
