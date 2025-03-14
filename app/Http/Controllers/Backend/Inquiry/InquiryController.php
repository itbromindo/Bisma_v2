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

    public function show($id)
    {
        return response()->json(['message' => 'This is the show method for ID: ' . $id]);
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
}
