<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OriginInquiry extends Model
{
    use HasFactory;
    protected $table = 'origin_inquiries';
    protected $primaryKey = 'origin_inquiry_id';
    public $timestamps = false;
    protected $fillable = [
        'origin_inquiry_code',
        'origin_inquiry_name',
        'origin_inquiry_created_at',
        'origin_inquiry_created_by',
        'origin_inquiry_updated_at',
        'origin_inquiry_updated_by',
        'origin_inquiry_deleted_at',
        'origin_inquiry_deleted_by',
        'origin_inquiry_notes',
        'origin_inquiry_soft_delete'
    ];
}
