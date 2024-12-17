<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescriptionQuotation extends Model
{
    use HasFactory;

    protected $table = 'description_quotations'; 
    protected $primaryKey = 'template_inquiry_desc_id'; 
    public $timestamps = false; 
    
    protected $fillable = [
        'template_inquiry_desc_code',
        'template_inquiry_desc_title',
        'template_inquiry_desc_text',
        'template_inquiry_desc_created_at',
        'template_inquiry_desc_created_by',
        'template_inquiry_desc_updated_at',
        'template_inquiry_desc_updated_by',
        'template_inquiry_desc_deleted_at',
        'template_inquiry_desc_deleted_by',
        'template_inquiry_desc_notes',
        'template_inquiry_desc_soft_delete',
    ];
}
