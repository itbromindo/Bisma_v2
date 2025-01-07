<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanytypeController extends Controller
{
    public function __construct()
    {
        $this->model = new Company_type();
        $this->mandatory = array(
            'company_type_name' => 'required',
            // 'company_type_notes' => 'required',
		);
    }

    public function index(Request $request)
    {      
        $this->checkAuthorization(auth()->user(), ['company_type.view']);
        $search = $request->search ?? '';

        $listdata = $this->model
        ->where(function($query) use ($search) {
            $query->where('company_type_name', 'like', '%' . $search . '%')
            ->orWhere('company_type_notes', 'like', '%' . $search . '%')
            ->orWhere('company_type_code', 'like', '%' . $search . '%');
        })
        ->where('company_type_soft_delete', 0)
        ->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'company_type' => $listdata,
                'search' => $search,
            ]);
        }

        return view('backend.pages.company_type.index', [
            'company_type' => $listdata,
            'search' => $search
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['company_type.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['company_type.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
                'column' => $validator->errors()->keys()[0],
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'company_type_code' => $this->setcode($this->model->count() + 1, 'CPT', 4), // (@nomor_urut, @kode, @panjang_kode)
            'company_type_name' => $request->company_type_name, 
            'company_type_notes' => $request->company_type_notes, 
            'company_type_created_at' => date("Y-m-d h:i:s"),
            'company_type_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['company_type.edit']);

        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
                'column' => $validator->errors()->keys()[0],
			];
			return response()->json($messages);
		}

        $result = $this->model->find($id)->update([
            'company_type_name' => $request->company_type_name, 
            'company_type_notes' => $request->company_type_notes, 
            'company_type_updated_at' => date("Y-m-d h:i:s"),
            'company_type_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['company_type.delete']);

        $result = $this->model->find($id)->update([
            'company_type_deleted_at' => date("Y-m-d h:i:s"),
            'company_type_deleted_by' => Session::get('user_code'),
            'company_type_soft_delete' => 1,
        ]);
        session()->flash('success', 'company_type has been deleted.');
        return $result;
    }
}