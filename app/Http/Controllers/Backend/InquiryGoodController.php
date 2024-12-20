<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InquiryGood;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InquiryGoodController extends Controller
{
    public function __construct()
    {
        $this->model = new InquiryGood();
        $this->mandatory = [
            'inquiry_goods_status_code' => 'nullable|string|max:225',
            'inquiry_goods_status_name' => 'required|string|max:225',
            'inquiry_goods_status_notes' => 'nullable|string',
        ];
    }

    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_goods.view']);

        $search = $_GET['search'] ?? '';

        $listdata = $this->model->where('inquiry_goods_status_name', 'like', '%'. $search .'%')->where('inquiry_goods_status_soft_delete', 0)->paginate(15);

        return view('backend.pages.inquiry_goods.index', [
            'inquiry_goods' => $listdata,
            'search' => $search
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_goods.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_goods.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'inquiry_goods_status_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'inquiry_goods_status_name' => $request->inquiry_goods_status_name,
            'inquiry_goods_status_notes' => $request->inquiry_goods_status_notes,
            'inquiry_goods_status_created_at' => now(),
            'inquiry_goods_status_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Inquiry Good has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_goods.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'inquiry_goods_status_name' => $request->inquiry_goods_status_name,
            'inquiry_goods_status_notes' => $request->inquiry_goods_status_notes,
            'inquiry_goods_status_status' => $request->inquiry_goods_status_status ?? 'default_value',
            'inquiry_goods_status_updated_at' => date("Y-m-d h:i:s"),
            'inquiry_goods_status_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Inquiry Good has been updated.'));
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_goods.delete']);

        $result = $this->model->find($id)->update([
            'inquiry_goods_status_deleted_at' => now(),
            'inquiry_goods_status_deleted_by' => Session::get('user_code'),
            'inquiry_goods_status_soft_delete' => 1,
        ]);

        session()->flash('success', __('Inquiry Good has been deleted.'));
        return $result;
    }
}
