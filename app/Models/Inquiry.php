<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inquiry extends Model
{
    protected $table = 'inquiry';
    public $timestamps = false;
    protected $primaryKey = 'inquiry_code';

    public function getListCardInquiry($stage)
    {
        $data = DB::table('inquiry as i')
                    ->select(
                        'i.inquiry_id',
                        'i.inquiry_end_date',
                        'it.inquiry_type_name',
                        'i.inquiry_code',
                        'i.inquiry_stage_progress',
                        'c.customer_name',
                        'u.users_name',
                        DB::raw("IF(i.inquiry_stage_progress = 'in progress', 'yellow', 'danger') as inquiry_stage_progress_color"),
                        DB::raw('GROUP_CONCAT(ut.users_photo) as users_photo')
                    )
                    ->join('inquiry_type as it', 'i.inquiry_type', '=', 'it.inquiry_type_code')
                    ->join('customer as c', 'i.inquiry_customer', '=', 'c.customer_code')
                    ->join('users as u', 'i.inquiry_sales', '=', 'u.user_code')
                    ->leftJoin('users as ut', function ($join) {
                        $join->on(DB::raw("JSON_CONTAINS(i.inquiry_teams, JSON_QUOTE(ut.user_code), '$')"), '=', DB::raw('1'));
                    })
                    ->where('i.inquiry_soft_delete', 0)
                    ->where('i.inquiry_stage', $stage)
                    ->groupBy('i.inquiry_code')
                    ->get();

        return $data;
    }
}
