<?php

namespace App\Http\Controllers\Backend\Inquiry;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquiryProduct;
use App\Models\DescriptionQuotation;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Pdf;

class InquirysupplyonlyController extends Controller
{
    public function __construct()
    {
        $this->modelheader = new Inquiry();
        $this->modeldetail = new InquiryProduct();
        $this->modeldesc = new DescriptionQuotation();
        $this->mandatory = [
        //     'cities_name' => 'required',
        //     'cities_code' => 'nullable|string|max:225',
            // 'cities_status' => 'nullable|string|max:225',
            // 'provinces_code' => 'required',
        ];
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['supplyonly.view']);

        $search = $_GET['search'] ??'';
        $desc = $this->modeldesc
            ->select('template_inquiry_desc_text as description')
            ->where('template_inquiry_desc_soft_delete', 0)
            ->limit(1)
            ->get();
        
        return view('backend.pages.inquiry.indexsupplyonly', [
            // 'listdata' => $listdata,
            'description' => $desc[0]->description ?? 'Description not found',
        ]);
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['supplyonly.create']);
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
        $code_inquiry = $request->input('nomor_left').'/'.$getcountheader.'/'.$getmonthtodayRoman.'/'.$getyeartoday;
        // return json_encode($request->input('kategori'));

        $inquiry = $this->modelheader->create([
            'inquiry_code' => $code_inquiry, // FS/5643/PMS/I/2024
            'inquiry_type' => '', // IT0001
            'inquiry_start_date' => date("Y-m-d h:i:s"), // 2024-04-02 22:18:39
            'inquiry_end_date' => date("Y-m-d h:i:s"), // 2024-04-02 22:18:39
            'inquiry_customer' => $request->input('nama_customer') ?? '', // CSR000008
            'inquiry_origin' => '', // ORIGIN003
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
            'inquiry_teams' => '["admin1", "user1"]', // ["admin1", "user1"] ??
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
                    'inquiry_product_code' => $this->setcode($this->modeldetail->count() + 1, 'DETISO', 6), // (@nomor_urut, @kode, @panjang_kode),
                    'inquiry_code' => $code_header,
                    'goods_code' => $detail['produk_code'] ?? '',
                    'inquiry_product_name' => $detail['produk_name'] ?? '',
                    'inquiry_product_status_quote_no_quote' => '',
                    'inquiry_product_qty' => $detail['qty'] ?? 0,
                    'inquiry_product_status_on_inquiry' => $detail['status'] ?? '',
                    'inquiry_product_uom' => $detail['satuan'] ?? '',
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
        
        $code_inquiry = $request->input('nomor_left').'/'.$getcountheader.'/'.$getmonthtodayRoman.'/'.$getyeartoday;

        $data = array(
            'data' => $request->all(),
            'code_header' => $code_inquiry,
        );

        $pdf = Pdf::loadView('backend.pages.inquiry.indexpreviewpdfsupplyonly', compact('data'));
        return $pdf->stream('preview.pdf');
    }
}
