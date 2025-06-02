<?php

namespace App\Http\Controllers\Backend\Inquiry;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquiryProduct;
use App\Models\DescriptionQuotation;
use App\Models\ParameterDuedate;
use App\Models\Product_divisions;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Pdf;
use DB;

class InquirysupplyonlyController extends Controller
{
    public function __construct()
    {
        $this->modelheader = new Inquiry();
        $this->modeldetail = new InquiryProduct();
        $this->modeldesc = new DescriptionQuotation();
        $this->modelduedate = new ParameterDuedate();
        $this->modelproduct = new Product_divisions();
        $this->modelcustomer = new Customer();
        $this->mandatory = [
        //     'cities_name' => 'required',
        //     'cities_code' => 'nullable|string|max:225',
            // 'cities_status' => 'nullable|string|max:225',
            // 'provinces_code' => 'required',
        ];
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.viewsupplyonly']);

        $search = $_GET['search'] ??'';
        $desc = $this->modeldesc
            ->select('template_inquiry_desc_text as description')
            ->where('template_inquiry_desc_soft_delete', 0)
            ->limit(1)
            ->get();

        $product = $this->modelproduct
            ->select('product_divisions_code as code', 'product_divisions_name as name')
            ->where('product_divisions_soft_delete', 0)
            ->get();
        
        return view('backend.pages.inquiry.indexsupplyonly', [
            // 'listdata' => $listdata,
            'description' => $desc[0]->description ?? 'Description not found',
            'listproduct' => $product,
            'method' => 'store',
            'dataheader' => [],
            'datadetail' => [],
            'id' => '',
            'datauser' => [],
        ]);
    }

    public function edit_data($iddata)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.editsupplyonly']);

        $modelheader = $this->modelheader
            ->select('*','inquiry_code as code_inquiry')
            ->where('inquiry_id', $iddata)
            ->where('inquiry_soft_delete', 0)
            ->get();

        $modeldetail = [];
        if ($modelheader) {
            $modeldetail = $this->modeldetail
            ->select('*')
            ->where('inquiry_code', $modelheader[0]->code_inquiry)
            ->get();
        }

        $product = $this->modelproduct
            ->select('product_divisions_code as code', 'product_divisions_name as name')
            ->where('product_divisions_soft_delete', 0)
            ->get();

        // return $modeldetail;

        return view('backend.pages.inquiry.indexsupplyonly', [
            'description' => $modelheader[0]->inquiry_notes ?? 'Description not found',
            'listproduct' => $product,
            'method' => 'edit',
            'dataheader' => $modelheader,
            'datadetail' => $modeldetail,
            'id' => $iddata,
            'datauser' => $this->search_customer($modelheader[0]->inquiry_customer) ?? '-',
        ]);
        
    }

    public function search_customer($code)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->modelcustomer
            ->select(
                'customer.customer_code as id',
                'customer.customer_name as text',
                'customer.customers_existing',
                'customer.customers_full_address',
                'customer.customers_phone',
                'customer.customers_email',
                'customer.customers_PIC',
                'customer.customers_npwp',
                'customer.customers_village',
                'customer.districts_code',
                'cities.cities_code',
                'cities.cities_name',
                'provinces.provinces_code',
                'provinces.provinces_name'
            )
            ->join('provinces', 'provinces.provinces_code', '=', 'customer.provinces_code')
            ->join('cities', 'cities.cities_code', '=', 'customer.cities_code')
            ->where('customer.customer_code', '=', $code)
            ->where('customer.customers_soft_delete', 0)
            ->get();


        return response()->json($listdata);
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.createsupplyonly']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
                'column' => $validator->errors()->keys()[0],
			];
            session()->flash('error', $validator->errors()->first());
            return response()->json($messages);
		}

        $getcountheader = $this->modelheader->count() + 1;
        $getyeartoday = date('Y');
        $getmonthtoday = date('m');
        $romanMonths = [
            '01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV',
            '05' => 'V', '06' => 'VI', '07' => 'VII', '08' => 'VIII',
            '09' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'
        ];
        $getmonthtodayRoman = $romanMonths[$getmonthtoday] ?? $getmonthtoday;
        
        $code_header = $this->setcode($getcountheader, 'HEAISO', 6);
        $code_inquiry = $this->setcodeproduct($request->input('nomor_left')).'/'.$getcountheader.'/BMM/'.$getmonthtodayRoman.'/'.$getyeartoday;
        $duedate = $this->modelduedate
            ->select('param_duedate_time as time')
            ->where('user_code', Session::get('user_code'))
            ->where('param_duedate_soft_delete', 0)
            ->limit(1)
            ->get();

        // time inquiry_end_date timestamp + $duedate[0]->time (dalam jam)
        $end_date = date("Y-m-d H:i:s", strtotime("+".$duedate[0]->time." hours"));
        // return json_encode($request->input('kategori'));

        $inquiry = $this->modelheader->create([
            'inquiry_code' => $code_inquiry, // FS/5643/PMS/I/2024
            'inquiry_type' => 'IT0001', // IT0001
            'inquiry_start_date' => date("Y-m-d h:i:s"), // 2024-04-02 22:18:39
            'inquiry_end_date' => $end_date, // 2024-04-02 22:18:39
            'inquiry_customer' => $request->input('nama_customer') ?? '', // CSR000008
            'inquiry_origin' => $request->input('permintaan_dari'), // ORIGIN003
            'inquiry_stage' => 'STATUS001', // STATUS009
            'inquiry_stage_progress' => 'in progress', // in progress
            'inquiry_product_division' => json_encode(
                is_array($request->input('kategori'))
                ? $request->input('kategori')
                : explode(',', $request->input('kategori') ?? '')
            ), // ["FS", "FE", "FH"]
            'inquiry_warehouse' => $request->input('permintaan_stock') ?? '', // WRH0001
            'inquiry_customer_type' => $request->input('user_code') ?? '', // End User
            'inquiry_oc' => 0, // 0
            'inquiry_expedition' => $request->input('permintaan_pengiriman_name') ?? '', // Kurir Bromindo
            'inquiry_expedition_service' => '', // 
            'inquiry_expedition_route' => '', // 
            'inquiry_expedition_estimation_date' => '', // 
            'inquiry_shipping_cost' => $request->input('permintaan_ongkir') ?? 0, // 15000.00
            'inquiry_wording_card_header' => '', // 
            'inquiry_tax' => $request->input('harga_ppn') ?? 0, // 0.00
            'inquiry_total_no_tax' => $request->input('harga_tanpa_ppn') ?? 0, // 0.00
            'inquiry_grand_total' => $request->input('harga_total') ?? 0, // 0.00
            'inquiry_product_grand_total_status' => '', // 
            'inquiry_sales' => 'admin1', // admin1 ??
            'inquiry_footer_note_inquiry' => '', // 
            'inquiry_flag_quote' => '', // 
            'inquiry_teams' => '["'.Session::get('user_code').'"]', // ["admin1", "user1"] ??
            'inquiry_created_at' => date("Y-m-d h:i:s"),
            'inquiry_created_by' => Session::get('user_code'),
            'inquiry_updated_at' => '',
            'inquiry_updated_by' => '',
            'inquiry_deleted_at' => '',
            'inquiry_deleted_by' => '',
            'inquiry_notes' => $request->input('keterangan') ?? '', // lorem ipsum
            'inquiry_soft_delete' => 0
        ]);

        // Ambil data detail dari request (dalam format JSON)
        $details = json_decode($request->input('details'), true);

        // Pastikan `details` ada dan bukan null
        if (!empty($details)) {
            foreach ($details as $detail) {
                $this->modeldetail->create([
                    'inquiry_product_code' => $this->setcode($this->modeldetail->count() + 1, 'DETISO', 6),
                    'inquiry_code' => $code_inquiry,
                    'goods_code' => $detail['produk_code'] ?? '',
                    'inquiry_product_name' => $detail['produk_name'] ?? '',
                    'inquiry_product_status_quote_no_quote' => '',
                    'inquiry_product_qty' => $detail['qty'] ?? 0,
                    'inquiry_product_status_on_inquiry' => $detail['status'] ?? '',
                    'inquiry_product_uom' => $detail['satuan'] ?? '', // ini tolong ganti dengan kode satuan
                    'inquiry_product_cost_of_goods' => 0, 
                    'inquiry_product_pricelist' => $detail['harga_unit'] ?? 0,
                    'inquiry_product_net_price' => $detail['harga_net'] ?? 0,
                    'inquiry_taxes_percent' => $detail['taxes'] ?? 0,
                    'inquiry_taxes_nominal' => 0, 
                    'inquiry_product_total_price' => $detail['harga_total'] ?? 0,
                    'inquiry_product_reason_no_quote' => '',
                ]);
            }
        }

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.editsupplyonly']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
                'column' => $validator->errors()->keys()[0],
			];
            session()->flash('error', $validator->errors()->first());
            return response()->json($messages);
		}

        $inquiry = $this->modelheader
        ->where('inquiry_id', $id)
        ->update([
            'inquiry_customer' => $request->input('nama_customer') ?? '', // CSR000008
            'inquiry_origin' => $request->input('permintaan_dari'), // ORIGIN003
            'inquiry_product_division' => json_encode(
                is_array($request->input('kategori'))
                ? $request->input('kategori')
                : explode(',', $request->input('kategori') ?? '')
            ), // ["FS", "FE", "FH"]
            'inquiry_warehouse' => $request->input('permintaan_stock') ?? '', // WRH0001
            'inquiry_customer_type' => $request->input('user_code') ?? '', // End User
            'inquiry_expedition' => $request->input('permintaan_pengiriman_name') ?? '', // Kurir Bromindo
            'inquiry_shipping_cost' => $request->input('permintaan_ongkir') ?? 0, // 15000.00
            'inquiry_tax' => $request->input('harga_ppn') ?? 0, // 0.00
            'inquiry_total_no_tax' => $request->input('harga_tanpa_ppn') ?? 0, // 0.00
            'inquiry_grand_total' => $request->input('harga_total') ?? 0, // 0.00
            'inquiry_updated_at' => now(),
            'inquiry_updated_by' => Session::get('user_code'),
            'inquiry_notes' => $request->input('keterangan') ?? '', 
        ]);

        $code_header = $this->modelheader
            ->select('inquiry_code as code_inquiry')
            ->where('inquiry_id', $id)
            ->where('inquiry_soft_delete', 0)
            ->first();

        $code_inquiry = $code_header->code_inquiry;

        // Hapus semua detail yang ada untuk inquiry ini
        $detail_hapus = $this->modeldetail->where('inquiry_code', $code_inquiry)->delete();

        // Ambil data detail dari request (dalam format JSON)
        $details = json_decode($request->input('details'), true);

        if (!empty($details)) {
            foreach ($details as $detail) {
                $this->modeldetail->create([
                    'inquiry_product_code' => $this->setcode($this->modeldetail->count() + 1, 'DETISO', 6),
                    'inquiry_code' => $code_inquiry,
                    'goods_code' => $detail['produk_code'] ?? '',
                    'inquiry_product_name' => $detail['produk_name'] ?? '',
                    'inquiry_product_status_quote_no_quote' => '',
                    'inquiry_product_qty' => $detail['qty'] ?? 0,
                    'inquiry_product_status_on_inquiry' => $detail['status'] ?? '',
                    'inquiry_product_uom' => $detail['satuan'] ?? '', // ini tolong ganti dengan kode satuan
                    'inquiry_product_cost_of_goods' => 0, 
                    'inquiry_product_pricelist' => $detail['harga_unit'] ?? 0,
                    'inquiry_product_net_price' => $detail['harga_net'] ?? 0,
                    'inquiry_taxes_percent' => $detail['taxes'] ?? 0,
                    'inquiry_taxes_nominal' => 0, 
                    'inquiry_product_total_price' => $detail['harga_total'] ?? 0,
                    'inquiry_product_reason_no_quote' => '',
                ]);
            }
        }

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function previewpdf(Request $request) {

        $getcountheader = $this->modelheader->count() + 1;
        $getyeartoday = date('Y');
        $getmonthtoday = date('m');
        $romanMonths = [
            '01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV',
            '05' => 'V', '06' => 'VI', '07' => 'VII', '08' => 'VIII',
            '09' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'
        ];
        $getmonthtodayRoman = $romanMonths[$getmonthtoday] ?? $getmonthtoday;

        
        
        $code_inquiry = $this->setcodeproduct($request->input('nomor_left')).'/'.$getcountheader.'/BMM/'.$getmonthtodayRoman.'/'.$getyeartoday;

        $data = array(
            'data' => $request->all(),
            'code_header' => $code_inquiry,
        );

        $pdf = Pdf::loadView('backend.pages.inquiry.indexpreviewpdfsupplyonly', compact('data'));
        return $pdf->stream('preview.pdf');
    }

    public function setcodeproduct($code)
    {
        $get_code_left = $this->modelproduct
            ->select('product_divisions_name as code')
            ->where('product_divisions_soft_delete', 0)
            ->where('product_divisions_code', $code)
            ->limit(1)
            ->get();

        return $get_code_left[0]->code ?? '-';
    }
}
