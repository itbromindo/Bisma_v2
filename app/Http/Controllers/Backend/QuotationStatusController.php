<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\QuotationStatus;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuotationStatusController extends Controller
{
    public function __construct()
    {
        $this->model = new QuotationStatus();
        $this->mandatory = array(
            'quotation_status_code' => 'nullable|unique:quotation_statuses,quotation_status_code|max:225',
            'quotation_status_name' => 'required|max:225',
            'quotation_status_notes' => 'nullable',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['quotation_statuses.view']);
        $listdata = $this->model
            ->where('quotation_status_soft_delete', 0)
            ->paginate(15);

        return view('backend.pages.quotation_statuses.index', [
            'quotation_statuses' => $listdata,
        ]);
    }

     /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['quotation_statuses.view']);
        $model = $this->model->find($id);
        return $model;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['quotation_statuses.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->first(),
                'status' => 401,
            ]);
        }

        $result = $this->model->create([
            'quotation_status_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'quotation_status_name' => $request->quotation_status_name,
            'quotation_status_notes' => $request->quotation_status_notes,
            'quotation_status_created_at' => now(),
            'quotation_status_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Quotation Status has been created.');
        return $result;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['quotation_statuses.edit']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->first(),
                'status' => 401,
            ]);
        }

        $this->model->find($id)->update([
            'quotation_status_name' => $request->quotation_status_name,
            'quotation_status_notes' => $request->quotation_status_notes,
            'quotation_status_updated_at' => now(),
            'quotation_status_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Quotation Status has been updated.');
        return $request;
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['quotation_statuses.delete']);
        $result = $this->model->find($id)->update([
            'quotation_status_deleted_at' => now(),
            'quotation_status_deleted_by' => Session::get('user_code'),
            'quotation_status_soft_delete' => 1,
        ]);

        session()->flash('success', 'Quotation Status has been deleted.');
        return $result;
    }

    /**
     * Restore a soft-deleted resource.
     */
    public function restore($id)
    {
        $this->model->find($id)->update([
            'quotation_status_deleted_at' => null,
            'quotation_status_deleted_by' => null,
            'quotation_status_soft_delete' => 0,
        ]);

        session()->flash('success', 'Quotation Status has been restored.');
        return redirect()->route('quotation_statuses.index');
    }

    /**
     * Permanently delete the resource from storage.
     */
    public function permanentDelete($id)
    {
        $this->checkAuthorization(auth()->user(), ['quotation_statuses.delete']);
        $this->model->find($id)->delete();

        session()->flash('success', 'Quotation Status has been permanently deleted.');
        return redirect()->route('quotation_statuses.index');
    }
}
