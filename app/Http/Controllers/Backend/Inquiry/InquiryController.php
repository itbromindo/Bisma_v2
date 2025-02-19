<?php

namespace App\Http\Controllers\Backend\Inquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    public function __construct()
    {
        // $this->model = new City();
        // $this->mandatory = [
        //     'cities_name' => 'required',
        //     'cities_code' => 'nullable|string|max:225',
            // 'cities_status' => 'nullable|string|max:225',
            // 'provinces_code' => 'required',
        // ];
    }

    public function index(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['inquiry.view']);

        $search = $_GET['search'] ??'';

        // $listdata = $this->model->with('province') 
        // ->where('cities_name', 'like', '%' . $search . '%')
        // ->where('cities_soft_delete', 0)
        // ->paginate(15);

        // $provinces = Province::select('provinces_code', 'provinces_name')->where('provinces_soft_delete',0)->orderBy('provinces_name', 'asc')->get();

        // if($request -> ajax()){
        //     return response()->json([
        //         'cities'=> $listdata,
        //     ]);
        // }
        
        return view('backend.pages.inquiry.index', [
            // 'cities' => $listdata,
            // 'provinces' => $provinces
        ]);
    }
}
