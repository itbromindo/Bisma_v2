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
            'description' => $desc[0]->description,
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

        $code_header = $this->setcode($this->modelheader->count() + 1, 'HEAISO', 6);

        $inquiry = $this->modelheader->create([
            'inquiry_code' => $code_header,
            'inquiry_type' => 'Supply Only',
            'inquiry_soft_delete' => 0,
            // 'inquiry_start_date' => '',
            // 'inquiry_end_date' => '',
            'inquiry_customer' => $request->input('nama_customer') ?? '',
            'inquiry_origin' => $request->input('permintaan_dari') ?? '', // perlu di convert 1 = WA, 2 = Email, 3 = Telepon, dll
            // 'inquiry_stage' => '',
            // 'inquiry_stage_progress' => '',
            'inquiry_product_division' => '', // belum 
            'inquiry_warehouse' => $request->input('permintaan_stock') ?? '', // data di form belum ambil dari master gudang
            // 'inquiry_customer_type' => '',
            // 'inquiry_oc' => '',
            // 'inquiry_shipping_cost' => '',
            // 'inquiry_wording_card_header' => '',
            'inquiry_tax' => $request->input('harga_ppn') ?? 0,
            'inquiry_total_no_tax' => $request->input('harga_tanpa_ppn') ?? 0,
            'inquiry_grand_total' => $request->input('harga_total') ?? 0,
            // 'inquiry_product_grand_total_status' => '',
            // 'inquiry_sales' => '',
            // 'inquiry_footer_note_inquiry' => '',
            // 'inquiry_flag_quote' => '',
            // 'inquiry_teams' => '',
            // 'inquiry_total_files' => '',
            // 'inquiry_total_chats' => '',
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
                    'inquiry_product_status_quote_no_quote' => null,
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
}
