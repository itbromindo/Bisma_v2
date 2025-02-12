<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomercategoryController extends Controller
{
    public function __construct()
    {
        $this->model = new Customer_category();
        $this->mandatory = array(
            'customer_category_name' => 'required',
            // 'customer_category_notes' => 'required',
		);
    }

    public function index(Request $request)
    {      
        $this->checkAuthorization(auth()->user(), ['customer_category.view']);
        $search = $request->search ?? '';

        $listdata = $this->model
        ->where(function($query) use ($search) {
            $query->where('customer_category_name', 'like', '%' . $search . '%')
            ->orWhere('customer_category_notes', 'like', '%' . $search . '%')
            ->orWhere('customer_category_code', 'like', '%' . $search . '%');
        })
        ->where('customer_category_soft_delete', 0)
        ->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'customer_category' => $listdata,
                'search' => $search,
            ]);
        }

        return view('backend.pages.customer_category.index', [
            'customer_category' => $listdata,
            'search' => $search
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['customer_category.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['customer_category.create']);
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
            'customer_category_code' => $this->setcode($this->model->count() + 1, 'CSC', 4), // (@nomor_urut, @kode, @panjang_kode)
            'customer_category_name' => $request->customer_category_name, 
            'customer_category_notes' => $request->customer_category_notes, 
            'customer_category_created_at' => date("Y-m-d h:i:s"),
            'customer_category_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['customer_category.edit']);

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
            'customer_category_name' => $request->customer_category_name, 
            'customer_category_notes' => $request->customer_category_notes, 
            'customer_category_updated_at' => date("Y-m-d h:i:s"),
            'customer_category_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['customer_category.delete']);

        $result = $this->model->find($id)->update([
            'customer_category_deleted_at' => date("Y-m-d h:i:s"),
            'customer_category_deleted_by' => Session::get('user_code'),
            'customer_category_soft_delete' => 1,
        ]);
        session()->flash('success', 'customer_category has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('customer_category_code as id', 'customer_category_name as text')
            ->where('customer_category_name', 'like', '%' . $search . '%')
            ->where('customer_category_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
