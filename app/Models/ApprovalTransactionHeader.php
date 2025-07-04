<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApprovalTransactionHeader extends Model
{
    use HasFactory;
    protected $table = 'approval_transaction_header';
    public $timestamps = false;
    protected $primaryKey = 'approval_transaction_header_id';
    protected $fillable = [
        'approval_transaction_header_code',
        'master_approvals_code',
        'transaction_number',
        'approval_transaction_header_start_date',
        'approval_transaction_header_end_date',
        'approval_transaction_header_stage_progress',
        'approval_transaction_header_created_by',
        'approval_transaction_header_created_at',
        'approval_transaction_header_updated_by',
        'approval_transaction_header_updated_at',
        'approval_transaction_header_deleted_by',
        'approval_transaction_header_deleted_at',
        'approval_transaction_header_notes',
        'approval_transaction_header_soft_delete',
    ];
    
    public function details(): HasMany
    {
        return $this->hasMany(
            ApprovalTransactionDetail::class,
            'approval_transaction_header_code', // Foreign key di tabel 'approval_transaction_detail'
            'approval_transaction_header_code'  // Local key di tabel 'approval_transaction_header'
        );
    }
}