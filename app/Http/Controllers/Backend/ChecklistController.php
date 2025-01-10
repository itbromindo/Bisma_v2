<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\Pillar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{
    public function __construct()
    {
        $this->model = new Checklist();
        $this->mandatory = array(
            'checklist_code' => 'nullable|string|max:225',
            'pillar_code' => 'required|string|max:225',
            'checklist_items' => 'required|string|max:225',
            'checklist_notes' => 'nullable|string|max:1000',
        );
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['checklists.view']);
        $search = $_GET['search'] ?? '';
    
        $listdata = $this->model->with('pillar')
            ->where('checklist_soft_delete', 0)
            ->where('checklist_items', 'like', '%' . $search . '%')
            ->paginate(15);
    
        $pillars = Pillar::select('pillar_code', 'pillar_items')->where('pillar_soft_delete', 0)->orderBy('pillar_items', 'asc')->get(); 

        if($request->ajax()){
            return response()->json([
                'checklists' => $listdata,
            ]);
        }
    
        return view('backend.pages.checklists.index', [
            'checklists' => $listdata,
            'pillars' => $pillars,
            'search' => $search,
        ]);
    }
    

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['checklists.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['checklists.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
                'column' => $validator->errors()->keys()[0],
            ];
            return response()->json($messages);
        }

        // Check if the pillar exists
        $pillar = Pillar::where('pillar_code', $request->pillar_code)->first();
        if (!$pillar) {
            return response()->json(['data' => 'Pillar not found', 'status' => 404]);
        }

        $result = $this->model->create([
            'checklist_code' => 'CL' . str_pad((string)($this->model->count() + 1), 3, '0', STR_PAD_LEFT),
            'pillar_code' => $request->pillar_code,
            'checklist_items' => $request->checklist_items,
            'checklist_notes' => $request->checklist_notes,
            'checklist_created_at' => now(),
            'checklist_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Checklist has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['checklists.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
                'column' => $validator->errors()->keys()[0],
            ];
            return response()->json($messages);
        }

        // Check if the checklist exists
        $checklist = $this->model->find($id);
        if (!$checklist) {
            return response()->json(['data' => 'Checklist not found', 'status' => 404]);
        }

        $result = $checklist->update([
            'checklist_items' => $request->checklist_items,
            'checklist_notes' => $request->checklist_notes,
            'pillar_code' => $request->pillar_code,
            'checklist_updated_at' => now(),
            'checklist_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Checklist has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['checklists.delete']);

        $checklist = $this->model->find($id);
        if (!$checklist) {
            return response()->json(['data' => 'Checklist not found', 'status' => 404]);
        }

        $result = $checklist->update([
            'checklist_deleted_at' => now(),
            'checklist_deleted_by' => Session::get('user_code'),
            'checklist_soft_delete' => 1,
        ]);

        session()->flash('success', 'Checklist has been deleted.');
        return $result;
    }

    public function combo(Request $request)
    {
        // $this->checkAuthorization(auth()->user(), ['checklists.view']);
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';
        $listdata = $this->model
            ->select('checklist_code as id', 'checklist_items as text')
            ->where('checklist_items', 'like', '%' . $search . '%')
            ->where('checklist_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
    
}
