<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UomController extends Controller
{
    public function __construct()
    {
        $this->model = new Uom();
        $this->mandatory = array(
            'uom_name' => 'required',
            'uom_notes' => 'required',
		);
    }

    public function index()
    {      
        $this->checkAuthorization(auth()->user(), ['uom.view']);

        $listdata = $this->model
        ->where('uom_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.uom.index', [
            'uom' => $listdata,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['uom.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['uom.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'uom_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'uom_name' => $request->uom_name, 
            'uom_notes' => $request->uom_notes, 
            'uom_created_at' => date("Y-m-d h:i:s"),
            'uom_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['uom.edit']);

        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->find($id)->update([
            'uom_name' => $request->uom_name, 
            'uom_notes' => $request->uom_notes, 
            'uom_updated_at' => date("Y-m-d h:i:s"),
            'uom_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['uom.delete']);

        $result = $this->model->find($id)->update([
            'uom_deleted_at' => date("Y-m-d h:i:s"),
            'uom_deleted_by' => Session::get('user_code'),
            'uom_soft_delete' => 1,
        ]);
        session()->flash('success', 'uom has been deleted.');
        return $result;
    }
}
