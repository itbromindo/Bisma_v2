<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionChecklist extends Model
{
    use HasFactory;

    protected $table = 'option_checklist';

    protected $primaryKey = 'option_checklist_id';

    public $timestamps = false;

    protected $fillable = [
        'option_checklist_code',
        'checklist_code',
        'option_checklist_items',
        'option_checklist_created_at',
        'option_checklist_created_by',
        'option_checklist_updated_at',
        'option_checklist_updated_by',
        'option_checklist_deleted_at',
        'option_checklist_deleted_by',
        'option_checklist_notes',
        'option_checklist_soft_delete',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'checklist_code', 'checklist_code');
    }
}
