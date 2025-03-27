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
                        'i.inquiry_product_division',
                        'c.customer_name',
                        'u.users_name',
                        'oi.origin_inquiry_name',
                        DB::raw("IF(i.inquiry_stage_progress = 'in progress', 'yellow', 'red') as inquiry_stage_progress_color"),
                        DB::raw('GROUP_CONCAT(ut.users_photo) as users_photo')
                    )
                    ->join('inquiry_type as it', 'i.inquiry_type', '=', 'it.inquiry_type_code')
                    ->join('customer as c', 'i.inquiry_customer', '=', 'c.customer_code')
                    ->join('users as u', 'i.inquiry_sales', '=', 'u.user_code')
                    ->join('origin_inquiries as oi', 'i.inquiry_origin', '=', 'oi.origin_inquiry_code')
                    ->leftJoin('users as ut', function ($join) {
                        $join->on(DB::raw("JSON_CONTAINS(i.inquiry_teams, JSON_QUOTE(ut.user_code), '$')"), '=', DB::raw('1'));
                    })
                    ->where('i.inquiry_soft_delete', 0)
                    ->where('i.inquiry_stage', $stage)
                    ->groupBy('i.inquiry_code')
                    ->get();

        return $data;
    }

    public function detailInquiry($id)
    {
        $query = DB::table('inquiry as i')
                ->select(
                    'i.inquiry_code', 
                    'i.inquiry_product_division',
                    DB::raw("CONCAT(DATE_FORMAT(i.inquiry_start_date, '%d %b %Y'), ' (', DATE_FORMAT(i.inquiry_start_date, '%H:%i'), ')') AS create_date"),
                    DB::raw("CONCAT(DATE_FORMAT(i.inquiry_end_date, '%d %b %Y'), ' (', DATE_FORMAT(i.inquiry_end_date, '%H:%i'), ')') AS due_date"),
                    'c.customer_name',
                    'c.customers_full_address',
                    'c.customers_phone',
                    'c.customers_email',
                    'c.customers_PIC',
                    'u.users_name',
                    'u.users_email',
                    'u.users_personal_phone',
                    'is2.inquiry_status_name',
                    'it.inquiry_type_name',
                    'oi.origin_inquiry_name',
                    'p.provinces_name',
	                'c2.cities_name' 
                )
                ->join('customer as c', 'i.inquiry_customer', '=', 'c.customer_code')
                ->join('users as u', 'i.inquiry_created_by', '=', 'u.user_code')
                ->join('inquiry_statuses as is2', 'i.inquiry_stage', '=', 'is2.inquiry_status_code')
                ->join('inquiry_type as it', 'i.inquiry_type', '=', 'it.inquiry_type_code')
                ->join('origin_inquiries as oi', 'i.inquiry_origin', '=', 'oi.origin_inquiry_code')
                ->join('provinces as p', 'c.provinces_code', '=', 'p.provinces_code') 
                ->join('cities as c2', 'c.cities_code', '=', 'c2.cities_code') 
                ->where('i.inquiry_id', $id)
                ->first();

        return $query;
    }

    public function listPermintaanInquiry($id)
    {
        $query = DB::table('inquiry_product as ip')
                ->join('inquiry as i', 'ip.inquiry_code', '=', 'i.inquiry_code')
                ->join('goods as g', 'ip.goods_code', '=', 'g.goods_code')
                ->join('uom as u', 'ip.inquiry_product_uom', '=', 'u.uom_code')
                ->select(
                    'ip.inquiry_product_code',
                    'ip.inquiry_product_name',
                    'ip.inquiry_product_status_on_inquiry',
                    'ip.inquiry_product_qty',
                    'ip.inquiry_product_pricelist',
                    'ip.inquiry_product_net_price',
                    'ip.inquiry_taxes_percent',
                    'ip.inquiry_product_total_price',
                    'g.goods_name',
                    'g.goods_stock',
                    'u.uom_name'
                )
                ->where('i.inquiry_id', $id)
                ->get();

        return $query;
    }
}
