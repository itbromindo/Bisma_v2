<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryStatus extends Model
{
    use HasFactory;

    protected $table = 'inquiry_statuses'; 
    protected $primaryKey = 'inquiry_status_id'; 

    public $timestamps = false;

    protected $fillable = [
        'inquiry_status_code',
        'inquiry_status_name',
        'inquiry_status_created_at',
        'inquiry_status_created_by',
        'inquiry_status_updated_at',
        'inquiry_status_updated_by',
        'inquiry_status_deleted_at',
        'inquiry_status_deleted_by',
        'inquiry_status_notes',
        'inquiry_status_soft_delete',
    ];

}
