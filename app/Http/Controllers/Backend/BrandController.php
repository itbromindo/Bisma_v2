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
            'brand_notes' => 'required',
		);
    }

    public function index()
    {      
        $this->checkAuthorization(auth()->user(), ['brand.view']);

        $listdata = $this->model
        ->where('brand_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.brand.index', [
            'brand' => $listdata,
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
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'brand_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
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
}

