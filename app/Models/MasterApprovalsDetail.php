<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterApprovalsDetail extends Model
{
    protected $table = 'master_approvals_details';
    protected $primaryKey = 'master_approvals_details_id';
    public $timestamps = true;

    protected $fillable = [
        'master_approvals_code',
        'master_approvals_details_section',
        'master_approvals_details_approvers',
    ];

    public function approval()
    {
        return $this->belongsTo(MasterApproval::class, 'master_approvals_code', 'master_approvals_code');
    }

    public function level()
    {
        return $this->belongsTo(Levels::class, 'master_approvals_details_approvers', 'level_code');
    }

}
