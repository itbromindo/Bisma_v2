<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklists';

    protected $primaryKey = 'checklist_id';

    public $timestamps = false; // Adjust if you want to use timestamps

    protected $fillable = [
        'checklist_code',
        'pillar_code', // Foreign key to the Pillar table
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

    // Define the relationship to Pillar
    public function pillar()
    {
        return $this->belongsTo(Pillar::class, 'pillar_code', 'pillar_code');
    }
}
