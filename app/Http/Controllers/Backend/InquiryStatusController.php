<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InquiryStatus;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InquiryStatusController extends Controller
{
    public function __construct()
    {
        $this->model = new InquiryStatus();
        $this->mandatory = array(
            'inquiry_status_code' => 'nullable|string|max:225',
            'inquiry_status_name' => 'required|string|max:225',
            'inquiry_status_notes' => 'required|string|max:225',
        );
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_statuses.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
            ->where('inquiry_status_soft_delete', 0)
            ->where('inquiry_status_name', 'like', '%' . $search . '%')
            ->paginate(15);

        if($request->ajax()){
            return response()->json([
                'inquiry_statuses'=>$listdata
            ]);
        }

        return view('backend.pages.inquiry_statuses.index', [
            'inquiry_statuses' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_statuses.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_statuses.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'inquiry_status_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'inquiry_status_name' => $request->inquiry_status_name,
            'inquiry_status_notes' => $request->inquiry_status_notes,
            'inquiry_status_created_at' => now(),
            'inquiry_status_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Inquiry Status has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_statuses.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'inquiry_status_name' => $request->inquiry_status_name,
            'inquiry_status_notes' => $request->inquiry_status_notes,
            'inquiry_status_updated_at' => now(),
            'inquiry_status_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Inquiry Status has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry_statuses.delete']);

        $result = $this->model->find($id)->update([
            'inquiry_status_deleted_at' => now(),
            'inquiry_status_deleted_by' => Session::get('user_code'),
            'inquiry_status_soft_delete' => 1,
        ]);

        session()->flash('success', 'Inquiry Status has been deleted.');
        return $result;
    }
}
