<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TemplateWinLose;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TemplateWinLoseController extends Controller
{
    public function __construct()
    {
        $this->model = new TemplateWinLose();
        $this->mandatory = array(
            'template_win_loses_code' => 'nullable|string|max:225',
            'template_win_loses_title' => 'required|string|max:225',
            'template_win_loses_text' => 'required|string',
            'template_win_loses_notes' => 'nullable|string|max:225',
        );
    }
    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['template_win_loses.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
            ->where('template_win_loses_soft_delete', 0)
            ->where('template_win_loses_title', 'like', '%' . $search . '%')
            ->paginate(15);

        return view('backend.pages.template_win_loses.index', [
            'template_win_loses' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['template_win_loses.view']);
        $model = $this->model->find($id);
        return $model;
    }
    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['template_win_loses.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'template_win_loses_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'template_win_loses_title' => $request->template_win_loses_title,
            'template_win_loses_text' => $request->template_win_loses_text,
            'template_win_loses_notes' => $request->template_win_loses_notes,
            'template_win_loses_created_at' => now(),
            'template_win_loses_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Template Win Lose has been created.'));
        return $request;
    }
    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['template_win_loses.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'template_win_loses_title' => $request->template_win_loses_title,
            'template_win_loses_text' => $request->template_win_loses_text,
            'template_win_loses_notes' => $request->template_win_loses_notes,
            'template_win_loses_updated_at' => now(),
            'template_win_loses_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Template Win Lose has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['template_win_loses.delete']);

        $result = $this->model->find($id)->update([
            'template_win_loses_deleted_at' => now(),
            'template_win_loses_deleted_by' => Session::get('user_code'),
            'template_win_loses_soft_delete' => 1,
        ]);

        session()->flash('success', 'Template Win Lose has been deleted.');
        return $result;
    }
}
