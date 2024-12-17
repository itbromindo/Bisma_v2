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
            'pillar_code' => 'required|string|max:225',  // Relasi dengan tabel Pillar
            'checklist_items' => 'required|string|max:225',
            'checklist_notes' => 'nullable|string|max:1000',
        );
    }

    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['checklists.view']);

        $listdata = $this->model
            ->where('checklist_soft_delete', 0)
            ->paginate(15);

        return view('backend.pages.checklists.index', [
            'checklists' => $listdata,
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
            ];
            return response()->json($messages);
        }

        // Check if the pillar exists
        $pillar = Pillar::where('pillar_code', $request->pillar_code)->first();
        if (!$pillar) {
            return response()->json(['data' => 'Pillar not found', 'status' => 404]);
        }

        $result = $this->model->create([
            'checklist_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
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
}
