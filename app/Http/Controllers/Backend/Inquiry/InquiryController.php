<?php

namespace App\Http\Controllers\Backend\Inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function __construct()
    {
        $this->inquiry = new Inquiry();
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.view']);
        
        return view('backend.pages.inquiry.index');
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
