<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->model = new Warehouse();
        $this->mandatory = array(
            'warehouse_name' => 'required',
            'warehouse_notes' => 'required',
		);
    }

    public function index()
    {      
        $this->checkAuthorization(auth()->user(), ['warehouse.view']);

        $listdata = $this->model
        ->where('warehouse_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.warehouse.index', [
            'warehouse' => $listdata,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['warehouse.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['warehouse.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'warehouse_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'warehouse_name' => $request->warehouse_name, 
            'warehouse_notes' => $request->warehouse_notes, 
            'warehouse_created_at' => date("Y-m-d h:i:s"),
            'warehouse_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['warehouse.edit']);

        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->find($id)->update([
            'warehouse_name' => $request->warehouse_name, 
            'warehouse_notes' => $request->warehouse_notes, 
            'warehouse_updated_at' => date("Y-m-d h:i:s"),
            'warehouse_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['warehouse.delete']);

        $result = $this->model->find($id)->update([
            'warehouse_deleted_at' => date("Y-m-d h:i:s"),
            'warehouse_deleted_by' => Session::get('user_code'),
            'warehouse_soft_delete' => 1,
        ]);
        session()->flash('success', 'warehouse has been deleted.');
        return $result;
    }
}
