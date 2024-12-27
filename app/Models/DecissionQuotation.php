<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecissionQuotation extends Model
{
    use HasFactory;
    protected $table = 'template_decission_quotation';
    protected $primaryKey = 'template_decission_quotation_id';
    public $timestamps = false;
    protected $fillable = [
        'template_decission_quotation_code',
        'template_decission_quotation_title',
        'template_decission_quotation_text',
        'template_decission_quotation_created_at',
        'template_decission_quotation_created_by',
        'template_decission_quotation_updated_at',
        'template_decission_quotation_updated_by',
        'template_decission_quotation_deleted_at',
        'template_decission_quotation_deleted_by',
        'template_decission_quotation_notes',
        'template_decission_quotation_soft_delete',
    ];

    /**
     * Scope untuk hanya data yang aktif (soft_delete = 0).
     */
    public function scopeActive($query)
    {
        return $query->where('template_decission_quotation_soft_delete', 0);
    }

    /**
     * Scope untuk hanya data yang sudah soft deleted (soft_delete = 1).
     */
    public function scopeDeleted($query)
    {
        return $query->where('template_decission_quotation_soft_delete', 1);
    }
}
