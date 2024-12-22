<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Support\Renderable;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->model = new User();
        $this->mandatory = array(
            'users_name' => 'required', 
            // 'users_photo' => 'required|file|mimes:pdf|max:2048', 
            'users_email' => 'required', 
            'users_password' => 'required',
            'users_office_phone' => 'required',
            'users_personal_phone' => 'required',
            'users_join_date' => 'required',
            'users_level' => 'required',
            'users_company' => 'required',
            'users_homebase' => 'required',
            'users_division' => 'required',
            'users_department' => 'required',
            'users_shift' => 'required',
            'users_employee_status' => 'required',
            'users_join_date_employee_status' => 'required',
            'users_contract_period' => 'required',
            'users_notes' => 'required',
            'users_gender' => 'required',
            'users_place_date_of_birth' => 'required',
            'users_education' => 'required',
            'users_religion' => 'required',
            'users_family_status' => 'required',
            'users_address_of_domicile' => 'required',
            'users_address_of_id' => 'required',
            'users_family_card' => 'required',
            'users_fb' => 'required',
            'users_ig' => 'required',
            'users_bpjs_tk_number' => 'required',
            'users_bpjs_number' => 'required',
            'users_ktp_number' => 'required',
            // 'users_ktp_picture' => 'required|file|mimes:pdf|max:2048',
            // 'users_signature' => 'required|file|mimes:pdf|max:2048',
		);
    }

    public function index()
    {        
        $this->checkAuthorization(auth()->user(), ['users.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
        ->where(function($q) use ($search) {
            $q->where('users_name', 'like', '%' . $search . '%')
            ->orWhere('users_email', 'like', '%' . $search . '%')
            ->orWhere('users_office_phone', 'like', '%' . $search . '%');
        })
        ->where('users_soft_delete', 0)
        ->paginate(15);

        return view('backend.pages.users.index', [
            'users' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['users.view']);
        $user = $this->model
        ->leftjoin('level', 'level.level_code', '=', 'users.users_level')
        ->leftjoin('companies', 'companies.companies_code', '=', 'users.users_company')
        ->leftjoin('homebases', 'homebases.homebase_code', '=', 'users.users_homebase')
        ->leftjoin('divisions', 'divisions.division_code', '=', 'users.users_division')
        ->leftjoin('departments', 'departments.department_code', '=', 'users.users_department')
        ->leftjoin('shifts', 'shifts.shift_code', '=', 'users.users_shift')
        ->find($id);
        return $user;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['users.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->create([
            'user_code' => str_pad((string)mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'users_name' => $request->users_name, 
            'users_photo' => $request->users_photo, 
            'users_email' => $request->users_email, 
            'users_password' => Hash::make($request->users_password), 
            'users_office_phone' => $request->users_office_phone, 
            'users_personal_phone' => $request->users_personal_phone, 
            'users_join_date' => $request->users_join_date, 
            'users_level' => $request->users_level, 
            'users_company' => $request->users_company, 
            'users_homebase' => $request->users_homebase, 
            'users_division' => $request->users_division, 
            'users_department' => $request->users_department, 
            'users_shift' => $request->users_shift, 
            'users_employee_status' => $request->users_employee_status, 
            'users_join_date_employee_status' => $request->users_join_date_employee_status, 
            'users_contract_period' => $request->users_contract_period, 
            'users_notes' => $request->users_notes,
            'users_gender' => $request->users_gender,
            'users_place_date_of_birth' => $request->users_place_date_of_birth,
            'users_education' => $request->users_education,
            'users_religion' => $request->users_religion,
            'users_family_status' => $request->users_family_status,
            'users_address_of_domicile' => $request->users_address_of_domicile,
            'users_address_of_id' => $request->users_address_of_id,
            'users_family_card' => $request->users_family_card,
            'users_fb' => $request->users_fb,
            'users_ig' => $request->users_ig,
            'users_bpjs_tk_number' => $request->users_bpjs_tk_number,
            'users_bpjs_number' => $request->users_bpjs_number,
            'users_ktp_number' => $request->users_ktp_number,
            'users_ktp_picture' => $request->users_ktp_picture,
            'users_signature' => $request->users_signature,
            'users_created_at' => date("Y-m-d h:i:s"),
            'users_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('User has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $rules = $this->mandatory;

        if ($id) {
            $rules['users_password'] = 'nullable|min:4';
        }

        $this->checkAuthorization(auth()->user(), ['users.edit']);

        $validator = Validator::make($request->all(), $rules); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
			];
			return response()->json($messages);
		}

        $result = $this->model->find($id)->update([
            'users_name' => $request->users_name, 
            // 'users_photo' => $request->users_photo, 
            'users_email' => $request->users_email, 
            'users_password' => Hash::make($request->users_password), 
            'users_office_phone' => $request->users_office_phone, 
            'users_personal_phone' => $request->users_personal_phone, 
            'users_join_date' => $request->users_join_date, 
            'users_level' => $request->users_level, 
            'users_company' => $request->users_company, 
            'users_homebase' => $request->users_homebase, 
            'users_division' => $request->users_division, 
            'users_department' => $request->users_department, 
            'users_shift' => $request->users_shift, 
            'users_employee_status' => $request->users_employee_status, 
            'users_join_date_employee_status' => $request->users_join_date_employee_status, 
            'users_contract_period' => $request->users_contract_period, 
            'users_notes' => $request->users_notes,
            'users_gender' => $request->users_gender,
            'users_place_date_of_birth' => $request->users_place_date_of_birth,
            'users_education' => $request->users_education,
            'users_religion' => $request->users_religion,
            'users_family_status' => $request->users_family_status,
            'users_address_of_domicile' => $request->users_address_of_domicile,
            'users_address_of_id' => $request->users_address_of_id,
            'users_family_card' => $request->users_family_card,
            'users_fb' => $request->users_fb,
            'users_ig' => $request->users_ig,
            'users_bpjs_tk_number' => $request->users_bpjs_tk_number,
            'users_bpjs_number' => $request->users_bpjs_number,
            'users_ktp_number' => $request->users_ktp_number,
            // 'users_ktp_picture' => $request->users_ktp_picture,
            // 'users_signature' => $request->users_signature,
            'users_updated_at' => date("Y-m-d h:i:s"),
            'users_updated_by' => Session::get('user_code'),
        ]);

        session()->flash('success', 'Admin has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['users.delete']);

        $result = $this->model->find($id)->update([
            'users_deleted_at' => date("Y-m-d h:i:s"),
            'users_deleted_by' => Session::get('user_code'),
            'users_soft_delete' => 1,
        ]);
        session()->flash('success', 'Admin has been deleted.');
        return $result;
    }
}
