<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklists';

    protected $primaryKey = 'checklist_id';

    public $timestamps = false; 

    protected $fillable = [
        'checklist_code',
        'pillar_code', 
        'checklist_items',
        'checklist_created_at',
        'checklist_created_by',
        'checklist_updated_at',
        'checklist_updated_by',
        'checklist_deleted_at',
        'checklist_deleted_by',
        'checklist_notes',
        'checklist_soft_delete',
    ];

    public function pillar()
    {
        return $this->belongsTo(Pillar::class, 'pillar_code', 'pillar_code');
    }
}
