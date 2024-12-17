<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OriginInquiry;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OriginInquiryController extends Controller
{
    public function __construct()
    {
        $this->model = new OriginInquiry();
        $this->mandatory = array(
            'origin_inquiry_code' => 'nullable', 
            'origin_inquiry_name' => 'required', 
            'origin_inquiry_notes' => 'required',
        );
    }

    public function index(): Renderable
    {        
        $this->checkAuthorization(auth()->user(), ['origin_inquiries.view']);

        $listdata = $this->model
            ->where('origin_inquiry_soft_delete', 0)
            ->paginate(15);

        return view('backend.pages.origin_inquiries.index', [
            'origin_inquiries' => $listdata,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['origin_inquiries.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['origin_inquiries.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'origin_inquiry_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'origin_inquiry_name' => $request->origin_inquiry_name,
            'origin_inquiry_notes' => $request->origin_inquiry_notes, 
            'origin_inquiry_created_at' => date("Y-m-d h:i:s"),
            'origin_inquiry_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Origin Inquiry has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['origin_inquiries.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'origin_inquiry_name' => $request->origin_inquiry_name,
            'origin_inquiry_notes' => $request->origin_inquiry_notes,
            'origin_inquiry_updated_at' => date("Y-m-d h:i:s"),
            'origin_inquiry_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Origin Inquiry has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['origin_inquiries.delete']);

        $result = $this->model->find($id)->update([
            'origin_inquiry_deleted_at' => date("Y-m-d h:i:s"),
            'origin_inquiry_deleted_by' => Session::get('user_code'),
            'origin_inquiry_soft_delete' => 1,
        ]);
        session()->flash('success', 'Origin Inquiry has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';

        $listdata = $this->model
            ->select('origin_inquiry_code as id', 'origin_inquiry_name as text')
            ->where('origin_inquiry_name', 'like', '%' . $search . '%')
            ->where('origin_inquiry_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
