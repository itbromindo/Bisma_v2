<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationStatus extends Model
{
    use HasFactory;
    protected $table = 'quotation_statuses'; 
    protected $primaryKey = 'quotation_status_id'; // Primary key
    public $timestamps = false; 
    protected $fillable = [
        'quotation_status_code',
        'quotation_status_name',
        'quotation_status_created_at',
        'quotation_status_created_by',
        'quotation_status_updated_at',
        'quotation_status_updated_by',
        'quotation_status_deleted_at',
        'quotation_status_deleted_by',
        'quotation_status_notes',
        'quotation_status_soft_delete',
    ];

    /**
     * Scope untuk hanya data yang aktif (soft_delete = 0).
     */
    public function scopeActive($query)
    {
        return $query->where('quotation_status_soft_delete', 0);
    }

    /**
     * Scope untuk hanya data yang sudah soft deleted (soft_delete = 1).
     */
    public function scopeDeleted($query)
    {
        return $query->where('quotation_status_soft_delete', 1);
    }

    /**
     * Check apakah status sudah dihapus (soft delete).
     */
    public function isDeleted()
    {
        return $this->quotation_status_soft_delete === 1;
    }

    /**
     * Soft delete data (mengubah status menjadi soft delete).
     */
    public function softDelete($deletedBy)
    {
        $this->update([
            'quotation_status_soft_delete' => 1,
            'quotation_status_deleted_at' => now(),
            'quotation_status_deleted_by' => $deletedBy,
        ]);
    }

    /**
     * Restore data dari soft delete.
     */
    public function restore()
    {
        $this->update([
            'quotation_status_soft_delete' => 0,
            'quotation_status_deleted_at' => null,
            'quotation_status_deleted_by' => null,
        ]);
    }
}
