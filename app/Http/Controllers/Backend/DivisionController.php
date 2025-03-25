<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->model = new Division();
        $this->mandatory = [
            'division_code' => 'nullable|string|max:225',
            'companies_code' => 'required|string|max:225',
            'division_name' => 'required|string|max:225',
            'division_notes' => 'nullable|string',
        ];
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['divisions.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model->with('company')->where('division_name', 'like', '%' . $search . '%')->where('division_soft_delete', 0)->paginate(15);

        $companies = Company::select('companies_code', 'companies_name')->where('companies_soft_delete', 0)->orderBy('companies_name', 'asc')->get(); //relasi soft_deletes

        if($request -> ajax()){
            return response()->json([
                'divisions' => $listdata,
            ]);
        }

        return view('backend.pages.divisions.index', [
            'divisions' => $listdata,
            'search' => $search,
            'companies' => $companies,
        ]);

    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['divisions.view']);
        $model = $this->model
        ->leftjoin('companies', 'divisions.companies_code', '=', 'companies.companies_code')
        ->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['divisions.create']);

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
            'division_code' => 'DI' . str_pad((string)($this->model->count() + 1), 3, '0', STR_PAD_LEFT), //code
            'companies_code' => $request->companies_code,
            'division_name' => $request->division_name,
            'division_notes' => $request->division_notes,
            'division_created_at' => date("Y-m-d H:i:s"),
            'division_created_by' => Session::get('user_code'),
        ]);
        

        session()->flash('success', __('Division has been created.'));
        return $result;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['divisions.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
                'column' => $validator->errors()->keys()[0],
            ];
            return response()->json($messages);
        }

        $model = $this->model->find($id);

        if (!$model) {
            return response()->json([
                'data' => 'Division not found.',
                'status' => 404,
            ]);
        }

        $result = $model->update([
            'companies_code' => $request->companies_code,
            'division_name' => $request->division_name,
            'division_notes' => $request->division_notes,
            'division_updated_at' => date("Y-m-d H:i:s"),
            'division_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Division has been updated.'));
        return $result;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['divisions.delete']);

        $model = $this->model->find($id);

        if (!$model) {
            return response()->json([
                'data' => 'Division not found.',
                'status' => 404,
            ]);
        }

        $result = $model->update([
            'division_deleted_at' => date("Y-m-d H:i:s"),
            'division_deleted_by' => Session::get('user_code'),
            'division_soft_delete' => 1,
        ]);

        session()->flash('success', __('Division has been deleted.'));
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $filter = !empty($_GET['filter']) ? $_GET['filter'] : '';
        $listdata = $this->model
            ->select('division_code as id', 'division_name as text')
            ->where('division_name', 'like', '%' . $search . '%')
            ->where('division_soft_delete', 0);
        if ($filter) {
            $listdata = $listdata->where('companies_code', $filter);
        }
            $listdata = $listdata->get();

        return response()->json($listdata);
    }
}
