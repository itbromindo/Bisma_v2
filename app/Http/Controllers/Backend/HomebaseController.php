<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Homebase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomebaseController extends Controller
{
    public function __construct()
    {
        $this->model = new Homebase();
        $this->mandatory = [
            'homebase_code' => 'nullable|string|max:225',
            'companies_code' => 'required|string|max:225',
            'homebase_name' => 'required|string|max:225',
            'homebase_notes' => 'nullable|string',
        ];
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['homebases.view']);

        $search = $_GET['search'] ?? '';

        $listdata = $this->model->with('company')->where('homebase_name','like', '%'. $search. '%')->where('homebase_soft_delete', 0)->paginate(15);

        $companies = Company::select('companies_code', 'companies_name')->where('companies_soft_delete',0)->orderBy('companies_name', 'asc')->get();

        if($request -> ajax()){
            return response()->json([
                'homebases' => $listdata
            ]);
        }

        return view('backend.pages.homebases.index', [
            'homebases' => $listdata,
            'companies' => $companies,
            'search' => $search
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['homebases.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['homebases.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
                'column' => $validator->errors()->keys()[0],
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'homebase_code' => 'HB' . str_pad((string)($this->model->count() + 1), 3, '0', STR_PAD_LEFT),
            'companies_code' => $request->companies_code,
            'homebase_name' => $request->homebase_name,
            'homebase_notes' => $request->homebase_notes,
            'homebase_created_at' => date("Y-m-d h:i:s"),
            'homebase_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Homebase has been created.'));
        return $result;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['homebases.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
                'column' => $validator->errors()->keys()[0],
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'companies_code' => $request->companies_code,
            'homebase_name' => $request->homebase_name,
            'homebase_notes' => $request->homebase_notes,
            'homebase_updated_at' => date("Y-m-d h:i:s"),
            'homebase_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Homebase has been updated.');
        return $result;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['homebases.delete']);

        $result = $this->model->find($id)->update([
            'homebase_deleted_at' => date("Y-m-d h:i:s"),
            'homebase_deleted_by' => Session::get('user_code'),
            'homebase_soft_delete' => 1,
        ]);
        session()->flash('success', 'Homebase has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('homebase_code as id', 'homebase_name as text')
            ->where('homebase_name', 'like', '%' . $search . '%')
            ->where('homebase_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
