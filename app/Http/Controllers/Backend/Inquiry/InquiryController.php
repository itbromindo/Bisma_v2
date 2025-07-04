<?php

namespace App\Http\Controllers\Backend\Inquiry;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\InquiryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Pdf;

use App\Models\Inquiry;
use App\Models\InquiryType;
use App\Models\InquiryStatus;
use App\Models\OriginInquiry;
use App\Models\Product_divisions;

class InquiryController extends Controller
{
    public function __construct()
    {
        $this->inquiry = new Inquiry();
        $this->inquirydetail = new InquiryProduct();
        $this->goods = new Goods();
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.view']);
        $product_divisions = Product_divisions::where('product_divisions_soft_delete', 0)->select('product_divisions_id', 'product_divisions_code', 'product_divisions_name')->get();
        $origin_inquiry = OriginInquiry::where('origin_inquiry_soft_delete', 0)->select('origin_inquiry_id', 'origin_inquiry_code', 'origin_inquiry_name')->get();
        $inquiry_type = InquiryType::where('inquiry_type_status_soft_delete', 0)->select('inquiry_type_id', 'inquiry_type_code', 'inquiry_type_name')->get();
        $inquiry_status = InquiryStatus::where('inquiry_status_soft_delete', 0)->select('inquiry_status_id', 'inquiry_status_code', 'inquiry_status_name')->get();
        $search = $request->search;
        $filtertanggal = $request->filtertanggal;
        $filterjenis = $request->filterjenis;
        $filteruser = $request->filteruser;
        $filterstage = $request->filterstage;
        $filterstatus = $request->filterstatus;
        $filterasal = $request->filterasal;
        $filterkategori = $request->filterkategori;
        $filters = [
            'filtertanggal' => $filtertanggal,
            'filterjenis' => $filterjenis,
            'filteruser' => $filteruser,
            'filterstage' => $filterstage,
            'filterstatus' => $filterstatus,
            'filterasal' => $filterasal,
            'filterkategori' => $filterkategori
        ];
        return view('backend.pages.inquiry.index', compact('inquiry_type','inquiry_status','origin_inquiry','product_divisions','search','filtertanggal','filterjenis','filteruser','filterstage','filterstatus','filterasal','filterkategori','filters'));
    }

    public function update_stage(Request $request)
    {
        $id = $request->id;
        $stage = $request->stage;

        $data = [
            'inquiry_stage' => $stage,
            'inquiry_updated_at' => now(),
            'inquiry_updated_by' => Session::get('user_code')
        ];

        DB::table('inquiry')->where('inquiry_id', $id)->update($data);
        $messages = [
            'status' => 200,
            'data' => 'berhasil!'
        ];
        return response()->json($messages);
    }

    public function cancel_stage(Request $request)
    {
        $id = $request->id;
        $inquiry = Inquiry::where('inquiry_id', $id)->first();
        if($inquiry->inquiry_stage == 'STATUS001') {
            $inquiry->update([
                'inquiry_stage' => 'STATUS008', // waiting approval no batal
                'inquiry_updated_at' => now(),
                'inquiry_updated_by' => Session::get('user_code')
            ]);

            $messages = [
                'status' => 200,
                'data' => 'Berhasil!'
            ];
        }else{
            $messages = [
                'status' => 400,
                'data' => 'Gagal, terjadi kesalahan data!'
            ];
        }

        return response()->json($messages);
    }

    public function detail_inquiry($id)
    {
        $data = [
            'inquiry' => $this->inquiry->detailInquiry($id),
            'list_permintaan' => $this->inquiry->listPermintaanInquiry($id)
        ];

        $result = [
            'status' => 200,
            'data' => $data
        ];

        return response()->json($result);
    }

    public function download_inquiry(Request $request)
    {
        $id = $request->id;
        $data = [
            'inquiry' => $this->inquiry->detailInquiry($id),
            'details' => $this->inquiry->listPermintaanInquiry($id)
        ];

        $pdf = Pdf::loadView('backend.pages.inquiry.inquirypdf', compact('data'));
        return $pdf->stream('preview.pdf');
    }

    public function update_oncallprice(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.editoncallpress']);

        $get_detail = $this->inquirydetail
            ->where('inquiry_product_id', $id)
            ->first();

        $inquiry_code = $get_detail->inquiry_code;

        $insert_goods = $this->goods
            ->create([
                'goods_code' => $this->setcode($this->goods->count() + 1, 'GDS', 6), // (@nomor_urut, @kode, @panjang_kode)
                'goods_name' => $get_detail->inquiry_product_name,
                'goods_usage' => 'warehouse',
                'goods_specification' => 'umum',
                'brand_code' => $request->brand,
                'goods_price' => $request->harga_pokok,
                'goods_stock' => 0,
                'goods_end_user_margin' => $request->margin_enduser,
                'goods_contractor_margin' => $request->margin_kontraktor,
                'goods_reseller_margin' => $request->margin_reseller,
                'goods_pricelist_margon' => $request->margin_pricelist,
                'goods_end_user_price' => $request->price_enduser,
                'goods_contractor_price' => $request->price_kontraktor,
                'goods_reseller_price' => $request->price_reseller,
                'goods_pricelist_price' => $request->price_pricelist,
                'uom_code' => $request->satuan,
                'goods_weight' => 0,
                'product_division_code' => $request->type,
                'product_category_code' => $request->kategori,
                'goods_availability' => 'indent',
                'goods_notes' => 'barang hasil dari on call price',
                'goods_soft_delete' => 1,
                'goods_created_at' => date("Y-m-d h:i:s"),
                'goods_created_by' => Session::get('user_code'),
            ]);

        if($request->type_user == 'Reseller'){
            $harga_prod = $request->price_reseller;
        }else if($request->type_user == 'End User'){
            $harga_prod = $request->price_enduser;
        }else if($request->type_user == 'Kontraktor'){
            $harga_prod = $request->price_kontraktor;
        }else{
            $harga_prod = $request->price_pricelist;
        }

        $harga_total = $harga_prod*$get_detail->inquiry_product_qty;

        $update_detail = $this->inquirydetail
            ->where('inquiry_product_id', $id)
            ->update([
                'goods_code' => $insert_goods->goods_code,
                'inquiry_product_uom' => $request->satuan,
                'inquiry_product_pricelist' => $request->price_pricelist,
                'inquiry_product_net_price' => $harga_prod,
                'inquiry_product_total_price' => $harga_total,
            ]);

        $total_harga = $this->inquirydetail
            ->where('inquiry_code', $inquiry_code)
            ->sum('inquiry_product_total_price');


        $update_harga_header = $this->inquiry
            ->where('inquiry_code', $inquiry_code)
            ->update([
                'inquiry_grand_total' => $total_harga,
            ]);

        $get_detail_after = $this->inquirydetail
            ->where('inquiry_product_id', $id)
            ->first();

        return $get_detail_after;
    }

}
