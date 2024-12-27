<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterDuedate extends Model
{
    use HasFactory;

    protected $table = 'parameter_duedates';
    public $timestamps = false; 
    protected $primaryKey = 'param_duedate_id';
    protected $fillable = [
        'param_duedate_code',
        'param_duedate_name',
        'param_duedate_time',
        'user_code',
        'param_duedate_created_at',
        'param_duedate_created_by',
        'param_duedate_updated_at',
        'param_duedate_updated_by',
        'param_duedate_deleted_at',
        'param_duedate_deleted_by',
        'param_duedate_notes',
        'param_duedate_soft_delete',
    ];

    // Menambahkan relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_code', 'user_code');
    }
}
