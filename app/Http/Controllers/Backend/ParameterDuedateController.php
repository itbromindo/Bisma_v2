<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ParameterDuedate;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ParameterDuedateController extends Controller
{
    public function __construct()
    {
        $this->model = new ParameterDuedate();
        $this->mandatory = array(
            'param_duedate_code' => 'nullable',
            'param_duedate_name' => 'required',
            'param_duedate_time' => 'required|integer',
            'param_duedate_notes' => 'required',
            'user_code' => 'required|string|max:225',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        // $this->checkAuthorization(auth()->user(), ['parameter_duedate.view']);

        $listdata = $this->model
            ->where('param_duedate_soft_delete', 0)
            ->paginate(15);

        return view('backend.pages.parameter_duedates.index', [
            'parameter_duedates' => $listdata,
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['parameter_duedate.view']);
        $model = $this->model->find($id);
        return $model;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->checkAuthorization(auth()->user(), ['parameter_duedate.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'param_duedate_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'param_duedate_name' => $request->param_duedate_name,
            'param_duedate_time' => $request->param_duedate_time,
            'param_duedate_notes' => $request->param_duedate_notes,
            'user_code' => $request->user_code,
            'param_duedate_created_at' => date("Y-m-d h:i:s"),
            'param_duedate_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Parameter Due Date has been created.');
        return $request;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $this->checkAuthorization(auth()->user(), ['parameter_duedate.edit']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'param_duedate_name' => $request->param_duedate_name,
            'param_duedate_time' => $request->param_duedate_time,
            'param_duedate_notes' => $request->param_duedate_notes,
            'user_code' => $request->user_code,
            'param_duedate_updated_at' => date("Y-m-d h:i:s"),
            'param_duedate_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Parameter Due Date has been updated.');
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $this->checkAuthorization(auth()->user(), ['parameter_duedate.delete']);

        $result = $this->model->find($id)->update([
            'param_duedate_deleted_at' => date("Y-m-d h:i:s"),
            'param_duedate_deleted_by' => Session::get('user_code'),
            'param_duedate_soft_delete' => 1,
        ]);

        session()->flash('success', 'Parameter Due Date has been deleted.');
        return $result;
    }

    /**
     * Combo method for dropdown selection.
     */
    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';

        $listdata = $this->model
            ->select('param_duedate_code as id', 'param_duedate_name as text')
            ->where('param_duedate_name', 'like', '%' . $search . '%')
            ->where('param_duedate_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
