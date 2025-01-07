<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->model = new Brand();
        $this->mandatory = array(
            'brand_name' => 'required',
            // 'brand_notes' => 'required',
		);
    }

    public function index(Request $request)
    {      
        $this->checkAuthorization(auth()->user(), ['brand.view']);
        $search = $request->search ?? '';

        $listdata = $this->model
        ->where(function($query) use ($search) {
            $query->where('brand_name', 'like', '%' . $search . '%')
            ->orWhere('brand_notes', 'like', '%' . $search . '%')
            ->orWhere('brand_code', 'like', '%' . $search . '%');
        })
        ->where('brand_soft_delete', 0)
        ->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'brand' => $listdata,
                'search' => $search,
            ]);
        }

        return view('backend.pages.brand.index', [
            'brand' => $listdata,
            'search' => $search
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['brand.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['brand.create']);
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
            'brand_code' => $this->setcode($this->model->count() + 1, 'BRD', 4), // (@nomor_urut, @kode, @panjang_kode)
            'brand_name' => $request->brand_name, 
            'brand_notes' => $request->brand_notes, 
            'brand_created_at' => date("Y-m-d h:i:s"),
            'brand_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['brand.edit']);

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
            'brand_name' => $request->brand_name, 
            'brand_notes' => $request->brand_notes, 
            'brand_updated_at' => date("Y-m-d h:i:s"),
            'brand_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['brand.delete']);

        $result = $this->model->find($id)->update([
            'brand_deleted_at' => date("Y-m-d h:i:s"),
            'brand_deleted_by' => Session::get('user_code'),
            'brand_soft_delete' => 1,
        ]);
        session()->flash('success', 'brand has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('brand_code as id', 'brand_name as text')
            ->where('brand_name', 'like', '%' . $search . '%')
            ->where('brand_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}

