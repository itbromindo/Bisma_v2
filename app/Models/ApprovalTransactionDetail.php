<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApprovalTransactionDetail extends Model
{
    use HasFactory;
    protected $table = 'approval_transaction_detail';
    public $timestamps = false;
    protected $primaryKey = 'approval_transaction_detail_id';
    protected $fillable = [
        'approval_transaction_header_code',
        'master_approvals_details_id',
        'approval_transaction_detail_approvers',
        'approval_transaction_detail_decision',
        'approval_transaction_detail_approval_date',
        'approval_transaction_detail_start_date',
        'approval_transaction_detail_end_date',
        'approval_transaction_detail_reason',
        'approval_transaction_detail_created_by',
        'approval_transaction_detail_created_at',
        'approval_transaction_detail_updated_by',
        'approval_transaction_detail_updated_at',
    ];

    public function header(): BelongsTo
    {
        return $this->belongsTo(
            ApprovalTransactionHeader::class,
            'approval_transaction_header_code', // Foreign key di tabel ini ('approval_transaction_detail')
            'approval_transaction_header_code'  // Owner key di tabel parent ('approval_transaction_header')
        );
    }
}