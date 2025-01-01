<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->model = new Customer();
        $this->mandatory = array(
            'customer_name' => 'required',
            'customers_existing' => 'required',
            'customers_full_address' => 'required',
            'customers_phone' => 'required',
            'customers_email' => 'required',
            'customers_PIC' => 'required',
            'customers_npwp' => 'required',
            'customers_village' => 'required',
            'districts_code' => 'required',
            'cities_code' => 'required',
            'provinces_code' => 'required',
            'customers_category' => 'required',
            'customers_area' => 'required',
            // 'customers_notes' => 'required',
		);
    }

    public function index()
    {      
        $this->checkAuthorization(auth()->user(), ['customer.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
        ->where(function($q) use ($search){
            $q->where('customer_name', 'like', '%' . $search . '%')
            ->orWhere('customers_phone', 'like', '%' . $search . '%')
            ->orWhere('customers_full_address', 'like', '%' . $search . '%');
        })
        ->where('customers_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.customer.index', [
            'customer' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['customer.view']);
        $model = $this->model
        ->leftjoin('districts', 'districts.districts_code', '=', 'customer.districts_code')
        ->leftjoin('cities', 'cities.cities_code', '=', 'customer.cities_code')
        ->leftjoin('provinces', 'provinces.provinces_code', '=', 'customer.provinces_code')
        ->leftjoin('customer_category', 'customer_category.customer_category_code', '=', 'customer.customers_category')
        ->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['customer.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'customer_code' => $this->setcode($this->model->count() + 1, 'CSR', 6), // (@nomor_urut, @kode, @panjang_kode)
            'customer_name' => $request->customer_name, 
            'customers_existing' => $request->customers_existing, 
            'customers_full_address' => $request->customers_full_address, 
            'customers_phone' => $request->customers_phone,
            'customers_email' => $request->customers_email,
            'customers_PIC' => $request->customers_PIC,
            'customers_npwp' => $request->customers_npwp,
            'customers_village' => $request->customers_village,
            'districts_code' => $request->districts_code,
            'cities_code' => $request->cities_code,
            'provinces_code' => $request->provinces_code,
            'customers_category' => $request->customers_category,
            'customers_area' => $request->customers_area,
            'customers_notes' => $request->customers_notes,
            'customers_created_at' => date("Y-m-d h:i:s"),
            'customers_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['customer.edit']);

        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->find($id)->update([
            'customer_name' => $request->customer_name, 
            'customers_existing' => $request->customers_existing, 
            'customers_full_address' => $request->customers_full_address, 
            'customers_phone' => $request->customers_phone,
            'customers_email' => $request->customers_email,
            'customers_PIC' => $request->customers_PIC,
            'customers_npwp' => $request->customers_npwp,
            'customers_village' => $request->customers_village,
            'districts_code' => $request->districts_code,
            'cities_code' => $request->cities_code,
            'provinces_code' => $request->provinces_code,
            'customers_category' => $request->customers_category,
            'customers_area' => $request->customers_area,
            'customers_notes' => $request->customers_notes,
            'customers_updated_at' => date("Y-m-d h:i:s"),
            'customers_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['customer.delete']);

        $result = $this->model->find($id)->update([
            'customers_deleted_at' => date("Y-m-d h:i:s"),
            'customers_deleted_by' => Session::get('user_code'),
            'customers_soft_delete' => 1,
        ]);
        session()->flash('success', 'customer has been deleted.');
        return $result;
    }
}
