<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inquiry extends Model
{
    protected $table = 'inquiry';
    public $timestamps = false;
    protected $primaryKey = 'inquiry_code';
    protected $fillable = [
        'inquiry_code',
        'inquiry_type',
        'inquiry_created_at',
        'inquiry_created_by',
        'inquiry_updated_at',
        'inquiry_updated_by',
        'inquiry_deleted_at',
        'inquiry_deleted_by',
        'inquiry_notes',
        'inquiry_soft_delete',
        'inquiry_start_date',
        'inquiry_end_date',
        'inquiry_customer',
        'inquiry_origin', 
        'inquiry_stage',
        'inquiry_stage_progress',
        'inquiry_product_division',
        'inquiry_warehouse',
        'inquiry_customer_type',
        'inquiry_oc',
        'inquiry_shipping_cost',
        'inquiry_wording_card_header',
        'inquiry_tax',
        'inquiry_total_no_tax',
        'inquiry_grand_total',
        'inquiry_product_grand_total_status',
        'inquiry_sales',
        'inquiry_footer_note_inquiry',
        'inquiry_flag_quote',
        'inquiry_teams',
        'inquiry_total_files',
        'inquiry_total_chats',
    ];

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
