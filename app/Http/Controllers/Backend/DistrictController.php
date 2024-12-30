<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->model = new District();
        $this->mandatory = [
            'districts_name' => 'required|string|max:225',
            'districts_code' => 'nullable|string|max:225',
            'cities_code' => 'required',
            'districts_notes' => 'nullable|string',
        ];
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['districts.view']);

        $search = $_GET['search'] ??'';

        $listdata = $this->model->with('city')->where('districts_name', 'like', '%' . $search . '%')->where('districts_soft_delete', 0)->paginate(15);

        $cities = City::select('cities_code', 'cities_name')->where('cities_soft_delete',0)->orderBy('cities_name', 'asc')->get();

        if($request -> ajax()){
            return response()->json([
                'districts' => $listdata
            ]);
        }

        return view('backend.pages.districts.index', [
            'districts' => $listdata,
            'search' => $search,
            'cities'=> $cities
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['districts.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['districts.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'districts_code' => 'DC' . str_pad((string)($this->model->count() + 1), 3, '0', STR_PAD_LEFT),
            'cities_code' => $request->cities_code,
            'districts_name' => $request->districts_name,
            'districts_notes' => $request->districts_notes,
            // 'districts_status' => $request->districts_status,
            'districts_created_at' => date("Y-m-d h:i:s"),
            'districts_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('District has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['districts.edit']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'districts_name' => $request->districts_name,
            'cities_code' => $request->cities_code,
            'districts_notes' => $request->districts_notes,
            // 'districts_status' => $request->districts_status,
            'districts_updated_at' => date("Y-m-d h:i:s"),
            'districts_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('District has been updated.'));
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['districts.delete']);

        $result = $this->model->find($id)->update([
            'districts_deleted_at' => date("Y-m-d h:i:s"),
            'districts_deleted_by' => Session::get('user_code'),
            'districts_soft_delete' => 1,
        ]);

        session()->flash('success', __('District has been deleted.'));
        return $result;
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('districts_code as id', 'districts_name as text')
            ->where('districts_name', 'like', '%' . $search . '%')
            ->where('districts_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
