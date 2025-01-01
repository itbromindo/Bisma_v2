<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductcategoryController extends Controller
{
    public function __construct()
    {
        $this->model = new Product_category();
        $this->mandatory = array(
            'product_category_name' => 'required',
            // 'product_category_notes' => 'required',
		);
    }

    public function index()
    {      
        $this->checkAuthorization(auth()->user(), ['product_category.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
        ->where('product_category_name', 'like', '%' . $search . '%')
        ->where('product_category_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.product_category.index', [
            'product_category' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['product_category.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['product_category.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'product_category_code' => $this->setcode($this->model->count() + 1, 'PRC', 4), // (@nomor_urut, @kode, @panjang_kode)
            'product_category_name' => $request->product_category_name, 
            'product_category_notes' => $request->product_category_notes, 
            'product_category_created_at' => date("Y-m-d h:i:s"),
            'product_category_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['product_category.edit']);

        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->find($id)->update([
            'product_category_name' => $request->product_category_name, 
            'product_category_notes' => $request->product_category_notes, 
            'product_category_updated_at' => date("Y-m-d h:i:s"),
            'product_category_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['product_category.delete']);

        $result = $this->model->find($id)->update([
            'product_category_deleted_at' => date("Y-m-d h:i:s"),
            'product_category_deleted_by' => Session::get('user_code'),
            'product_category_soft_delete' => 1,
        ]);
        session()->flash('success', 'product_category has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('product_category_code as id', 'product_category_name as text')
            ->where('product_category_name', 'like', '%' . $search . '%')
            ->where('product_category_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
