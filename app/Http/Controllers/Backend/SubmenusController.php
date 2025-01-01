<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Submenus;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Permission;
use App\Models\Menus;

class SubmenusController extends Controller
{
    public function __construct()
    {
        $this->model = new Submenus();
        $this->permission = new Permission();
        $this->menu = new Menus();
        $this->mandatory = array(
            'menus_code' => 'required', 
            'submenus_name' => 'required',
            // 'submenus_notes' => 'required', 
		);
    }

    public function index(): Renderable
    {        
        $this->checkAuthorization(auth()->user(), ['submenus.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
        ->where('submenus_name', 'like', '%' . $search . '%')
        ->where('submenus_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.submenus.index', [
            'submenus' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['submenus.view']);
        $model = $this->model
        ->leftjoin('menus', 'submenus.menus_code', '=', 'menus.menus_code')
        ->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['submenus.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'submenus_code' => $this->setcode($this->model->count() + 1, 'SMN', 4), // (@nomor_urut, @kode, @panjang_kode)
            'menus_code' => $request->menus_code, 
            'submenus_name' => $request->submenus_name, 
            'submenus_notes' => $request->submenus_notes, 
            'submenus_created_at' => date("Y-m-d h:i:s"),
            'submenus_created_by' => Session::get('user_code'),
        ]);

        $permission = $this->permission->create([
            'name' => $request->submenus_name,
            'guard_name' => 'web',
            'group_name' => $this->namemenus($request->menus_code),
        ]);

        session()->flash('success', __('Menus has been created.'));
        return $request;
    }

    public function namemenus($kode){
        $model = $this->menu->where('menus_code', $kode)->first();
        return $model->menus_name;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['submenus.edit']);

        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}
        $result1 = $this->model->find($id);

        // update permission
        $this->permission
            ->where('name','=', $result1->submenus_name)
            ->update([
                'name' => $request->submenus_name,
                'group_name' => $this->namemenus($request->menus_code),
            ]);

        $result = $this->model->find($id)->update([
            'menus_code' => $request->menus_code, 
            'submenus_name' => $request->submenus_name, 
            'submenus_notes' => $request->submenus_notes, 
            'submenus_updated_at' => date("Y-m-d h:i:s"),
            'submenus_updated_by' => Session::get('user_code'),
        ]);


        session()->flash('success', 'Menus has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['submenus.delete']);

        $result = $this->model->find($id)->update([
            'submenus_deleted_at' => date("Y-m-d h:i:s"),
            'submenus_deleted_by' => Session::get('user_code'),
            'submenus_soft_delete' => 1,
        ]);

        // delete permission
        $permission = $this->permission->where('name', $this->model->find($id)->submenus_name)->delete();

        session()->flash('success', 'Menus has been deleted.');
        return $result;
    }
}
