<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Inquiry extends Model
{
    protected $table = 'inquiry';
    public $timestamps = false;
    protected $primaryKey = 'inquiry_code';
    public $incrementing = false;
    protected $keyType = 'string';
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
        'inquiry_date_and_location',
        'inquiry_stage',
        'inquiry_stage_progress',
        'inquiry_product_division',
        'inquiry_warehouse',
        'inquiry_customer_type',
        'inquiry_oc',
        'inquiry_expedition',
        'inquiry_expedition_service',
        'inquiry_expedition_route',
        'inquiry_expedition_estimation_date',
        'inquiry_shipping_cost',
        'inquiry_wording_card_header',
        'inquiry_tax',
        'inquiry_total_no_tax',
        'inquiry_grand_total',
        'inquiry_product_grand_total_status',
        'inquiry_sales',
        'inquiry_footer_note_inquiry',
        'inquiry_flag_quote',
        'inquiry_teams'
    ];

    public function getListCardInquiry($stage, $search = '', $filters = [])
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
                        'oi.origin_inquiry_name',
                        DB::raw("IF(i.inquiry_stage_progress = 'in progress', 'yellow', 'red') as inquiry_stage_progress_color"),
                        DB::raw('GROUP_CONCAT(DISTINCT ut.users_photo) as users_photo'),
                        DB::raw('GROUP_CONCAT(DISTINCT pd.product_divisions_name) as product_divisions_name')
                    )
                    ->join('inquiry_type as it', 'i.inquiry_type', '=', 'it.inquiry_type_code')
                    ->join('customer as c', 'i.inquiry_customer', '=', 'c.customer_code')
                    ->join('users as u', 'i.inquiry_sales', '=', 'u.user_code')
                    ->join('origin_inquiries as oi', 'i.inquiry_origin', '=', 'oi.origin_inquiry_code')
                    ->leftJoin('users as ut', function ($join) {
                        $join->on(DB::raw("JSON_CONTAINS(i.inquiry_teams, JSON_QUOTE(ut.user_code), '$')"), '=', DB::raw('1'));
                    })
                    ->leftJoin('product_divisions as pd', function ($join) {
                        $join->on(DB::raw("JSON_CONTAINS(i.inquiry_product_division, JSON_QUOTE(pd.product_divisions_code), '$')"), '=', DB::raw('1'));
                    })
                    ->where('i.inquiry_soft_delete', 0)
                    ->where('i.inquiry_stage', $stage)
                    ->groupBy('i.inquiry_code');

        if($search) {
            $data->whereAny([
                'c.customer_name',
                'i.inquiry_code'
            ], 'like', '%'.$search.'%');
        }

        if(!empty($filters['filtertanggal'])) {
            $data->whereRaw("DATE(i.inquiry_end_date) = ?", [$filters['filtertanggal']]);
        }

        if(!empty($filters['filterjenis'])) {
            $data->where('i.inquiry_type', [$filters['filterjenis']]);
        }

        if(!empty($filters['filteruser'])) {
            $data->where('i.inquiry_customer_type', [$filters['filteruser']]);
        }

        if(!empty($filters['filterstage'])) {
            $data->where('i.inquiry_stage', [$filters['filterstage']]);
        }

        if(!empty($filters['filterstatus'])) {
            $data->where('i.inquiry_stage_progress', [$filters['filterstatus']]);
        }

        if(!empty($filters['filterasal'])) {
            $data->where('i.inquiry_origin', [$filters['filterasal']]);
        }

        if (!empty($filters['filterkategori'])) {
            $data->whereRaw("JSON_CONTAINS(i.inquiry_product_division, '\"{$filters['filterkategori']}\"')");
        }

        $data->orderBy('i.inquiry_created_at', 'desc');

        return $data->get();
    }

    public function detailInquiry($id)
    {
        $query = DB::table('inquiry as i')
                ->select(
                    'i.inquiry_code',
                    'i.inquiry_product_division',
                    'i.inquiry_customer_type',
                    'i.inquiry_oc',
                    'i.inquiry_stage',
                    'i.inquiry_shipping_cost',
                    'i.inquiry_notes',
                    'i.inquiry_created_at',
                    DB::raw("DATE_FORMAT(i.inquiry_start_date, '%d %b %Y %H:%i') AS create_date"),
                    DB::raw("DATE_FORMAT(i.inquiry_end_date, '%d %b %Y %H:%i') AS due_date"),
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
	                'c2.cities_name',
                    'w.warehouse_name',
                    DB::raw('GROUP_CONCAT(DISTINCT pd.product_divisions_name) as product_divisions_name'),
                    'i.inquiry_stage'
                )
                ->leftjoin('customer as c', 'i.inquiry_customer', '=', 'c.customer_code')
                ->leftjoin('users as u', 'i.inquiry_created_by', '=', 'u.user_code')
                ->leftjoin('inquiry_statuses as is2', 'i.inquiry_stage', '=', 'is2.inquiry_status_code')
                ->leftjoin('inquiry_type as it', 'i.inquiry_type', '=', 'it.inquiry_type_code')
                ->leftjoin('origin_inquiries as oi', 'i.inquiry_origin', '=', 'oi.origin_inquiry_code')
                ->leftjoin('provinces as p', 'c.provinces_code', '=', 'p.provinces_code')
                ->leftjoin('cities as c2', 'c.cities_code', '=', 'c2.cities_code')
                ->leftjoin('warehouse as w', 'w.warehouse_code', '=', 'i.inquiry_warehouse')
                ->leftJoin('product_divisions as pd', function ($join) {
                    $join->on(DB::raw("JSON_CONTAINS(i.inquiry_product_division, JSON_QUOTE(pd.product_divisions_code), '$')"), '=', DB::raw('1'));
                })
                ->where('i.inquiry_id', $id)
                ->first();

        if (!$query) {
            return null;
        }

        // --- PENGECEKAN HAK AKSES ---

        $canApprove = false;
        $master_approvals_details_id = 0;
        $user = Auth::user();

        if ($user && $query->inquiry_stage == 'STATUS008') {

            $nextApprovalRule = DB::table('inquiry as i')
                ->join('approval_transaction_header as ath', 'i.inquiry_code', '=', 'ath.transaction_number')
                ->join('approval_transaction_detail as atd', 'ath.approval_transaction_header_code', '=', 'atd.approval_transaction_header_code')
                ->join('master_approvals as ma', 'ath.master_approvals_code', '=', 'ma.master_approvals_code')
                ->join('master_approvals_details as mad', function ($join) {
                    $join->on('ma.master_approvals_code', '=', 'mad.master_approvals_code')
                        ->on('mad.master_approvals_details_id', '=', 'atd.master_approvals_details_id');
                })
                ->where('atd.approval_transaction_detail_decision', 'Waiting Approval')
                ->where('i.inquiry_id', $id)
                ->orderBy('mad.master_approvals_details_section')
                ->select('ma.department_code', 'ma.division_code', 'mad.master_approvals_details_approvers as level_code', 'mad.master_approvals_details_id')
                ->first();

            if ($nextApprovalRule) {
                if (
                    $user->users_department == $nextApprovalRule->department_code &&
                    $user->users_division == $nextApprovalRule->division_code &&
                    $user->users_level == $nextApprovalRule->level_code
                ) {
                    $canApprove = true;
                    $master_approvals_details_id = $nextApprovalRule->master_approvals_details_id;
                }
            }
        }

        if ($user && $query->inquiry_stage == 'STATUS003') {

            $nextApprovalRule = DB::table('inquiry as i')
                ->join('approval_transaction_header as ath', 'i.inquiry_code', '=', 'ath.transaction_number')
                ->join('approval_transaction_detail as atd', 'ath.approval_transaction_header_code', '=', 'atd.approval_transaction_header_code')
                ->join('master_approvals as ma', 'ath.master_approvals_code', '=', 'ma.master_approvals_code')
                ->join('master_approvals_details as mad', function ($join) {
                    $join->on('ma.master_approvals_code', '=', 'mad.master_approvals_code')
                        ->on('mad.master_approvals_details_id', '=', 'atd.master_approvals_details_id');
                })
                ->where('atd.approval_transaction_detail_decision', 'Waiting Approval')
                ->where('i.inquiry_id', $id)
                ->orderBy('mad.master_approvals_details_section')
                ->select('ma.department_code', 'ma.division_code', 'mad.master_approvals_details_approvers as level_code', 'mad.master_approvals_details_id')
                ->first();

            if ($nextApprovalRule) {
                if (
                    $user->users_department == $nextApprovalRule->department_code &&
                    $user->users_division == $nextApprovalRule->division_code &&
                    $user->users_level == $nextApprovalRule->level_code
                ) {
                    $canApprove = true;
                    $master_approvals_details_id = $nextApprovalRule->master_approvals_details_id;
                }
            }
        }

        $query->can_approve = $canApprove;
        $query->master_approvals_details_id = $master_approvals_details_id;

        return $query;
    }

    public function listPermintaanInquiry($id)
    {
        $query = DB::table('inquiry_product as ip')
                ->leftjoin('inquiry as i', 'ip.inquiry_code', '=', 'i.inquiry_code')
                ->leftjoin('goods as g', 'ip.goods_code', '=', 'g.goods_code')
                ->leftjoin('uom as u', 'ip.inquiry_product_uom', '=', 'u.uom_code')
                ->select(
                    'ip.inquiry_product_id',
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
