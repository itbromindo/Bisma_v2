<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\OptionChecklist;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OptionChecklistController extends Controller
{
    public function __construct()
    {
        $this->model = new OptionChecklist();
        $this->mandatory = array(
            'option_checklist_code' => 'nullable|string|max:225',
            'checklist_code' => 'required|string|max:225',
            'option_checklist_items' => 'required|string|max:225',
            'option_checklist_notes' => 'nullable|string',
        );
    }

    /**
     * Display a listing of the option checklist.
     */
    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['optionchecklists.view']);
        $search = $_GET['search'] ?? '';

        $listData = $this->model->with('checklist')
            ->where('option_checklist_soft_delete', 0)
            ->where('option_checklist_items', 'like', '%' . $search . '%')
            ->paginate(15);

            $checklists = Checklist::select('checklist_code', 'checklist_items')->where('checklist_soft_delete', 0)->orderBy('checklist_items', 'asc')->get();

        if($request->ajax()){
            return response()->json([
                'option_checklist' => $listData,
            ]);
        }

        return view('backend.pages.optionchecklists.index', [
            'option_checklist' => $listData,
            'checklists' => $checklists,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new option checklist.
     */
    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['optionchecklists.view']);
        $model = $this->model->find($id);
        return $model;
    }

    /**
     * Store a newly created option checklist.
     */
    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['optionchecklists.create']);
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
            'option_checklist_code' => 'OC' . str_pad((string)($this->model->count() + 1), 3, '0', STR_PAD_LEFT),
            'checklist_code' => $request->checklist_code,
            'option_checklist_items' => $request->option_checklist_items,
            'option_checklist_notes' => $request->option_checklist_notes,
            'option_checklist_created_at' => now(),
            'option_checklist_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Option Checklist has been created.'));
        return response()->json(['status' => 200, 'message' => 'Success']);
    }

    /**
     * Update the specified option checklist.
     */
    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['optionchecklists.edit']);
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
            'option_checklist_items' => $request->option_checklist_items,
            'option_checklist_notes' => $request->option_checklist_notes,
            'checklist_code' => $request->checklist_code,
            'option_checklist_updated_at' => now(),
            'option_checklist_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Option Checklist has been updated.');
        return response()->json(['status' => 200, 'message' => 'Success']);
    }

    /**
     * Remove the specified option checklist.
     */
    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['optionchecklists.delete']);

        $result = $this->model->find($id)->update([
            'option_checklist_deleted_at' => now(),
            'option_checklist_deleted_by' => Session::get('user_code'),
            'option_checklist_soft_delete' => 1,
        ]);

        session()->flash('success', 'Option Checklist has been deleted.');
        return response()->json(['status' => 200, 'message' => 'Success']);
    }

    public function combo(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['optionchecklists.view']);
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('option_checklist_code as id', 'checklist_items as text')
            ->where('option_checklist_items', 'like', '%' . $search . '%')
            ->where('option_checklist_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
