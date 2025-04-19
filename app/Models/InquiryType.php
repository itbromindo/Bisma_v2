<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryType extends Model
{
    protected $table = 'inquiry_type'; 
    protected $primaryKey = 'inquiry_type_id'; 
    public $timestamps = false;
}
