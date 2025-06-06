<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use App\Models\MasterApproval;
use App\Models\MasterApprovalsDetail;
use App\Models\Department;
use App\Models\Division;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MasterApprovalController extends Controller
{
    public function __construct()
    {
        $this->model = new MasterApproval();
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.view']);

        $search = $_GET['search'] ?? '';

        $listdata = $this->model->with(['division', 'department', 'level'])
            ->where('master_approvals_approval_name', 'like', '%' . $search . '%')
            ->where('master_approvals_soft_delete', 0)
            ->paginate(15);


        $departments = Department::select('department_code', 'department_name')->where('department_soft_delete', 0)->orderBy('department_name', 'asc')->get();
        $division = Division::select('division_code', 'division_name')->where('division_soft_delete', 0)->orderBy('division_name', 'asc')->get();
        $levels = Levels::select('level_code', 'level_name')->where('level_soft_delete', 0)->orderBy('level_name', 'asc')->get();

        if ($request->ajax()) {
            return response()->json([
                'masterApprovals' => $listdata,
            ]);
        }

        return view('backend.pages.master_approvals.index', [
            'masterApprovals' => $listdata,
            'search' => $search,
            'departments' => $departments,
            'divisions' => $division,
            'levels' => $levels,
        ]);
    }

    public function create()
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.view']);

        $departments = Department::select('department_code', 'department_name')->where('department_soft_delete', 0)->orderBy('department_name', 'asc')->get();
        $division = Division::select('division_code', 'division_name')->where('division_soft_delete', 0)->orderBy('division_name', 'asc')->get();
        $levels = Levels::select('level_code', 'level_name')->where('level_soft_delete', 0)->orderBy('level_name', 'asc')->get();

        return view('backend.pages.master_approvals.form', [
            'departments' => $departments,
            'divisions' => $division,
            'levels' => $levels,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.view']);

        $approval = MasterApproval::with(['details.level'])
                    ->where('master_approvals_id', $id)
                    ->first();

        if (!$approval) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'approval' => $approval,
            'details' => $approval->details->map(function ($detail) {
                return [
                    'section' => $detail->master_approvals_details_section,
                    'approver_code' => $detail->master_approvals_details_approvers,
                    'level_name' => $detail->level->level_name
                ];
            }),
        ]);

    }

    public function edit($id)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.edit']);

        $departments = Department::select('department_code', 'department_name')->where('department_soft_delete', 0)->orderBy('department_name', 'asc')->get();
        $division = Division::select('division_code', 'division_name')->where('division_soft_delete', 0)->orderBy('division_name', 'asc')->get();
        $levels = Levels::select('level_code', 'level_name')->where('level_soft_delete', 0)->orderBy('level_name', 'asc')->get();

        $data = MasterApproval::findOrFail($id);

        return view('backend.pages.master_approvals.form', [
            'id' => $id,
            'data' => $data,
            'departments' => $departments,
            'divisions' => $division,
            'levels' => $levels,
        ]);
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['master_approvals.create']);

        $validated = $request->validate([
                    'master_approval_name' => 'required',
                    'division' => 'required',
                    'department' => 'required',
                    'level' => 'required',
                    'detail_section' => 'required|array',
                    'detail_section.*' => 'required|string',
                    'detail_atasan' => 'required|array',
                    'detail_atasan.*' => 'required|string',
                ]);

        try {
            DB::beginTransaction();
            $id = $request->master_approvals_id;

            $data = [
                        'master_approvals_approval_name' => $request->master_approval_name,
                        'division_code' => $request->division,
                        'department_code' => $request->department,
                        'level_code' => $request->level,
                        'master_approvals_notes' => $request->notes,
                    ];

            if($id) {
                $data['master_approvals_updated_at'] = now();
                $data['master_approvals_updated_by'] = Session::get('user_code');   
            }else{
                $data['master_approvals_created_at'] = now();
                $data['master_approvals_created_by'] = Session::get('user_code');
                $data['master_approvals_code'] = 'MA' . str_pad((string) ($this->model->count() + 1), 3, '0', STR_PAD_LEFT);
            }

            $master = MasterApproval::updateOrCreate(
                ['master_approvals_id' => $id],
                $data
            );

            $master->details()->delete();
            foreach ($request->detail_section as $i => $section) {
                $master->details()->create([
                    'master_approvals_code' => $master->master_approvals_code,
                    'master_approvals_details_section' => $section,
                    'master_approvals_details_approvers' => $request->detail_atasan[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Data berhasil disimpan.']);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validasi gagal.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan data.','error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        // Authorization check
        $this->checkAuthorization(auth()->user(), ['master_approvals.delete']);

        // Find the record
        $masterApproval = $this->model->find($id);

        // If not found
        if (!$masterApproval) {
            return response()->json([
                'data' => 'Master Approval not found',
                'status' => 404
            ], 404);
        }

        // Soft delete logic
        $result = $masterApproval->update([
            'master_approvals_deleted_at' => now(),
            'master_approvals_deleted_by' => Session::get('user_code'),
            'master_approvals_soft_delete' => 1,
        ]);

        if ($result) {
            return response()->json([
                'status' => 200,
                'message' => 'Data has been deleted successfully.'
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => 'Failed to delete Master Approval.'
        ], 500);
    }

}
