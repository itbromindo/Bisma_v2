<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use App\Models\MasterApproval;
use App\Models\Department;
use App\Models\Division;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MasterApprovalController extends Controller
{
    public function __construct()
    {
        $this->model = new MasterApproval();
        $this->mandatory = array(
            'master_approvals_code' => 'nullable|string|max:225',
            'master_approvals_approval_name' => 'required|string|max:225',
            'department_code' => 'required|string|max:225', 
            'division_code' => 'required|string|max:225',  
            'level_code' => 'required|string|max:225',   
            'master_approvals_notes' => 'nullable|string|max:1000',
        );
    }

    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.view']);

        $listdata = $this->model
            ->where('master_approvals_soft_delete', 0)
            ->paginate(15);

        return view('backend.pages.master_approvals.index', [
            'masterApprovals' => $listdata,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        // Check if related entities exist
        if (!Department::where('department_code', $request->department_code)->exists()) {
            return response()->json(['data' => 'Department not found', 'status' => 404]);
        }
        if (!Division::where('division_code', $request->division_code)->exists()) {
            return response()->json(['data' => 'Division not found', 'status' => 404]);
        }
        if (!Levels::where('level_code', $request->level_code)->exists()) {
            return response()->json(['data' => 'Level not found', 'status' => 404]);
        }

        $result = $this->model->create([
            'master_approvals_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'master_approvals_approval_name' => $request->master_approvals_approval_name,
            'department_code' => $request->department_code,
            'division_code' => $request->division_code,
            'level_code' => $request->level_code,
            'master_approvals_notes' => $request->master_approvals_notes,
            'master_approvals_created_at' => now(),
            'master_approvals_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Master Approval has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        // Check if the master approval exists
        $masterApproval = $this->model->find($id);
        if (!$masterApproval) {
            return response()->json(['data' => 'Master Approval not found', 'status' => 404]);
        }

        $result = $masterApproval->update([
            'master_approvals_approval_name' => $request->master_approvals_approval_name,
            'department_code' => $request->department_code,
            'division_code' => $request->division_code,
            'level_code' => $request->level_code,
            'master_approvals_notes' => $request->master_approvals_notes,
            'master_approvals_updated_at' => now(),
            'master_approvals_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Master Approval has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.delete']);

        $masterApproval = $this->model->find($id);
        if (!$masterApproval) {
            return response()->json(['data' => 'Master Approval not found', 'status' => 404]);
        }

        $result = $masterApproval->update([
            'master_approvals_deleted_at' => now(),
            'master_approvals_deleted_by' => Session::get('user_code'),
            'master_approvals_soft_delete' => 1,
        ]);

        session()->flash('success', 'Master Approval has been deleted.');
        return $result;
    }
}
