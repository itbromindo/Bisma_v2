<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product_divisions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductdivisionController extends Controller
{
    public function __construct()
    {
        $this->model = new Product_divisions();
        $this->mandatory = array(
            'product_divisions_name' => 'required',
            // 'product_divisions_notes' => 'required',
		);
    }

    public function index()
    {      
        $this->checkAuthorization(auth()->user(), ['product_divisions.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
        ->where(function($query) use ($search) {
            $query->where('product_divisions_name', 'like', '%' . $search . '%')
            ->orWhere('product_divisions_notes', 'like', '%' . $search . '%')
            ->orWhere('product_divisions_code', 'like', '%' . $search . '%');
        })
        ->where('product_divisions_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.product_divisions.index', [
            'product_divisions' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['product_divisions.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['product_divisions.create']);
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
            'product_divisions_code' => $this->setcode($this->model->count() + 1, 'PRD', 4), // (@nomor_urut, @kode, @panjang_kode)
            'product_divisions_name' => $request->product_divisions_name, 
            'product_divisions_notes' => $request->product_divisions_notes, 
            'product_divisions_created_at' => date("Y-m-d h:i:s"),
            'product_divisions_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['product_divisions.edit']);

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
            'product_divisions_name' => $request->product_divisions_name, 
            'product_divisions_notes' => $request->product_divisions_notes, 
            'product_divisions_updated_at' => date("Y-m-d h:i:s"),
            'product_divisions_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['product_divisions.delete']);

        $result = $this->model->find($id)->update([
            'product_divisions_deleted_at' => date("Y-m-d h:i:s"),
            'product_divisions_deleted_by' => Session::get('user_code'),
            'product_divisions_soft_delete' => 1,
        ]);
        session()->flash('success', 'product_divisions has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('product_divisions_code as id', 'product_divisions_name as text')
            ->where('product_divisions_name', 'like', '%' . $search . '%')
            ->where('product_divisions_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
