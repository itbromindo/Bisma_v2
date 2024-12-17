<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DescriptionQuotation;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DescriptionQuotationController extends Controller
{
    public function __construct()
    {
        $this->model = new DescriptionQuotation();
        $this->mandatory = array(
            'template_inquiry_desc_code' => 'nullable',
            'template_inquiry_desc_title' => 'required',
            'template_inquiry_desc_text' => 'required',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        // $this->checkAuthorization(auth()->user(), ['description_quotations.view']);

        $listdata = $this->model
            ->where('template_inquiry_desc_soft_delete', 0)
            ->paginate(15);

        return view('backend.pages.description_quotations.index', [
            'description_quotations' => $listdata,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $this->checkAuthorization(auth()->user(), ['description_quotations.view']);
        $model = $this->model->find($id);
        return $model;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->checkAuthorization(auth()->user(), ['description_quotations.create']);
        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->create([
            'template_inquiry_desc_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'template_inquiry_desc_title' => $request->template_inquiry_desc_title,
            'template_inquiry_desc_text' => $request->template_inquiry_desc_text,
            'template_inquiry_desc_created_at' => date("Y-m-d h:i:s"),
            'template_inquiry_desc_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Description Quotation has been created.'));
        return $request;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $this->checkAuthorization(auth()->user(), ['description_quotations.edit']);

        $validator = Validator::make($request->all(), $this->mandatory);

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors()->first(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $result = $this->model->find($id)->update([
            'template_inquiry_desc_title' => $request->template_inquiry_desc_title,
            'template_inquiry_desc_text' => $request->template_inquiry_desc_text,
            'template_inquiry_desc_updated_at' => date("Y-m-d h:i:s"),
            'template_inquiry_desc_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Description Quotation has been updated.');
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $this->checkAuthorization(auth()->user(), ['description_quotations.delete']);

        $result = $this->model->find($id)->update([
            'template_inquiry_desc_deleted_at' => date("Y-m-d h:i:s"),
            'template_inquiry_desc_deleted_by' => Session::get('user_code'),
            'template_inquiry_desc_soft_delete' => 1,
        ]);
        session()->flash('success', 'Description Quotation has been deleted.');
        return $result;
    }

    /**
     * Search and return options for select combo.
     */
    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';

        $listdata = $this->model
            ->select('template_inquiry_desc_code as id', 'template_inquiry_desc_title as text')
            ->where('template_inquiry_desc_title', 'like', '%' . $search . '%')
            ->where('template_inquiry_desc_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
