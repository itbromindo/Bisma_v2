<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pillar extends Model
{
    use HasFactory;

    protected $table = 'pillars';

    protected $primaryKey = 'pillar_id';

    public $timestamps = false;

    protected $fillable = [
        'pillar_code',
        'pillar_items',
        'pillar_created_at',
        'pillar_created_by',
        'pillar_updated_at',
        'pillar_updated_by',
        'pillar_deleted_at',
        'pillar_deleted_by',
        'pillar_notes',
        'pillar_soft_delete',
    ];

}
