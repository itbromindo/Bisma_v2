<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pillar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PillarController extends Controller
{
    public function __construct()
    {
        $this->model = new Pillar();
        $this->mandatory = array(
            'pillar_code' => 'nullable|string|max:225',
            'pillar_items' => 'required|string|max:225',
            'pillar_notes' => 'required|string|max:225',
        );
    }

    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['pillars.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
            ->where('pillar_soft_delete', 0)
            ->where('pillar_items', 'like', '%' . $search . '%')
            ->paginate(15);

        return view('backend.pages.pillars.index', [
            'pillars' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['pillars.view']);
        $model = $this->model->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['pillars.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'pillar_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'pillar_items' => $request->pillar_items,
            'pillar_notes' => $request->pillar_notes,
            'pillar_created_at' => now(),
            'pillar_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Pillar has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['pillars.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'pillar_items' => $request->pillar_items,
            'pillar_notes' => $request->pillar_notes,
            'pillar_updated_at' => now(),
            'pillar_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Pillar has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['pillars.delete']);

        $result = $this->model->find($id)->update([
            'pillar_deleted_at' => now(),
            'pillar_deleted_by' => Session::get('user_code'),
            'pillar_soft_delete' => 1,
        ]);

        session()->flash('success', 'Pillar has been deleted.');
        return $result;
    }
}
