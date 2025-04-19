<?php

namespace App\Http\Controllers\Backend\Inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Goods;
use App\Models\Inquiry;
use App\Models\InquiryType;
use App\Models\InquiryStatus;
use App\Models\OriginInquiry;

class InquiryController extends Controller
{
    public function __construct()
    {
        $this->inquiry = new Inquiry();
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.view']);
        $goods = Goods::where('goods_soft_delete', 0)->select('goods_id', 'goods_code', 'goods_name')->get();
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
        return view('backend.pages.inquiry.index', compact('inquiry_type','inquiry_status','origin_inquiry','goods','search','filtertanggal','filterjenis','filteruser','filterstage','filterstatus','filterasal','filterkategori','filters'));
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
}
