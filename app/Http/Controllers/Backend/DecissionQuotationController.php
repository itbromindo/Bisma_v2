<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DecissionQuotation;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DecissionQuotationController extends Controller
{
    public function __construct()
    {
        $this->model = new DecissionQuotation();
        $this->mandatory = array(
            'template_decission_quotation_code' => 'nullable|unique:template_decission_quotation,template_decission_quotation_code|max:225',
            'template_decission_quotation_title' => 'required|max:225',
            'template_decission_quotation_text' => 'required',
            'template_decission_quotation_notes' => 'nullable',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['decission_quotation.view']);
        $listdata = $this->model
            ->where('template_decission_quotation_soft_delete', 0)
            ->paginate(15);

        return view('backend.pages.decission_quotations.index', [
            'decission_quotations' => $listdata,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['decission_quotation.view']);
        $model = $this->model->find($id);
        return $model;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['decission_quotation.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->first(),
                'status' => 401,
            ]);
        }

        $result = $this->model->create([
            'template_decission_quotation_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'template_decission_quotation_title' => $request->template_decission_quotation_title,
            'template_decission_quotation_text' => $request->template_decission_quotation_text,
            'template_decission_quotation_notes' => $request->template_decission_quotation_notes,
            'template_decission_quotation_created_at' => now(),
            'template_decission_quotation_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Decission Quotation has been created.');
        return $request;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['decission_quotation.edit']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->first(),
                'status' => 401,
            ]);
        }

        $this->model->find($id)->update([
            'template_decission_quotation_title' => $request->template_decission_quotation_title,
            'template_decission_quotation_text' => $request->template_decission_quotation_text,
            'template_decission_quotation_notes' => $request->template_decission_quotation_notes,
            'template_decission_quotation_updated_at' => now(),
            'template_decission_quotation_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Decission Quotation has been updated.');
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['decission_quotation.delete']);
        $result = $this->model->find($id)->update([
            'template_decission_quotation_deleted_at' => now(),
            'template_decission_quotation_deleted_by' => Session::get('user_code'),
            'template_decission_quotation_soft_delete' => 1,
        ]);

        session()->flash('success', 'Decission Quotation has been deleted.');
        return $result;
    }

    /**
     * Restore a soft-deleted resource.
     */
    public function restore($id)
    {
        
        $this->model->find($id)->update([
            'template_decission_quotation_deleted_at' => null,
            'template_decission_quotation_deleted_by' => null,
            'template_decission_quotation_soft_delete' => 0,
        ]);

        session()->flash('success', 'Decission Quotation has been restored.');
        return redirect()->route('decission_quotations.index');
    }

    /**
     * Permanently delete the resource from storage.
     */
    public function permanentDelete($id)
    {
        $this->model->find($id)->delete();

        session()->flash('success', 'Decission Quotation has been permanently deleted.');
        return redirect()->route('decission_quotations.index');
    }

    /**
     * Search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');

        $listdata = $this->model
            ->where('template_decission_quotation_soft_delete', 0)
            ->where(function ($query) use ($search) {
                $query->where('template_decission_quotation_code', 'like', "%$search%")
                    ->orWhere('template_decission_quotation_title', 'like', "%$search%")
                    ->orWhere('template_decission_quotation_notes', 'like', "%$search%");
            })
            ->paginate(15);

        return view('backend.pages.decission_quotations.index', [
            'decission_quotations' => $listdata,
        ]);
    }
}
