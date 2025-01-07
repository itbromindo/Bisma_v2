<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Moduls;
use App\Models\Menus;

class LevelsController extends Controller
{
    public function __construct()
    {
        $this->model = new Levels();
        $this->modelmodul = new Moduls();
        $this->modelmenu = new Menus();
        $this->mandatory = array(
            'department_code' => 'required', 
            'level_name' => 'required',
            // 'level_notes' => 'required',
		);
    }

    public function index(Request $request)
    {      
        $this->checkAuthorization(auth()->user(), ['levels.view']);
        $search = $request->search ?? '';

        $listdata = $this->model
        ->where(function($query) use ($search) {
            $query->where('level_name', 'like', '%' . $search . '%')
            ->orWhere('level_notes', 'like', '%' . $search . '%')
            ->orWhere('level_code', 'like', '%' . $search . '%');
        })
        ->where('level_soft_delete', 0)
        ->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'levels' => $listdata,
                'search' => $search,
            ]);
        }

        return view('backend.pages.levels.index', [
            'levels' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['levels.view']);
        $model = $this->model
        ->leftjoin('departments', 'departments.department_code', '=', 'level.department_code')
        ->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['levels.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
                'column' => $validator->errors()->keys()[0],
			];
            session()->flash('error', $validator->errors()->first());
            return response()->json($messages);
		}

        $result = $this->model->create([
            'level_code' => $this->setcode($this->model->count() + 1, 'LVL', 4), // (@nomor_urut, @kode, @panjang_kode)
            'department_code' => $request->department_code, 
            'level_name' => $request->level_name, 
            'level_notes' => $request->level_notes, 
            'level_created_at' => date("Y-m-d h:i:s"),
            'level_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['levels.edit']);

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
            'department_code' => $request->department_code, 
            'level_name' => $request->level_name, 
            'level_notes' => $request->level_notes, 
            'level_updated_at' => date("Y-m-d h:i:s"),
            'level_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['levels.delete']);

        $result = $this->model->find($id)->update([
            'level_deleted_at' => date("Y-m-d h:i:s"),
            'level_deleted_by' => Session::get('user_code'),
            'level_soft_delete' => 1,
        ]);
        session()->flash('success', 'Level has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('level_code as id', 'level_name as text')
            ->where('level_name', 'like', '%' . $search . '%')
            ->where('level_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}