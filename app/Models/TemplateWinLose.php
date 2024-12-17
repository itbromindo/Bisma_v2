<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateWinLose extends Model
{
    use HasFactory;

    protected $table = 'template_win_loses';

    protected $primaryKey = 'template_win_loses_id';

    public $timestamps = false;

    protected $fillable = [
        'template_win_loses_code',
        'template_win_loses_title',
        'template_win_loses_text',
        'template_win_loses_created_at',
        'template_win_loses_created_by',
        'template_win_loses_updated_at',
        'template_win_loses_updated_by',
        'template_win_loses_deleted_at',
        'template_win_loses_deleted_by',
        'template_win_loses_notes',
        'template_win_loses_soft_delete',
    ];
}
