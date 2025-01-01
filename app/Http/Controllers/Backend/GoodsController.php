<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
    public function __construct()
    {
        $this->model = new Goods();
        $this->mandatory = array(
            'goods_name' => 'required',
            'goods_usage' => 'required',
            // 'goods_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'goods_specification' => 'required',
            'brand_code' => 'required',
            'goods_price' => 'required',
            'goods_stock' => 'required',
            'goods_end_user_margin' => 'required',
            'goods_contractor_margin' => 'required',
            'goods_reseller_margin' => 'required',
            'goods_pricelist_margon' => 'required',
            'goods_end_user_price' => 'required',
            'goods_contractor_price' => 'required',
            'goods_reseller_price' => 'required',
            'goods_pricelist_price' => 'required',
            'uom_code' => 'required',
            'goods_weight' => 'required',
            'product_division_code' => 'required',
            'product_category_code' => 'required',
            'goods_availability' => 'required',
		);
    }

    public function index()
    {      
        $this->checkAuthorization(auth()->user(), ['goods.view']);
        $search = $_GET['search'] ?? '';

        $listdata = $this->model
        ->where(function($q) use ($search){
            $q->where('goods_name', 'like', '%' . $search . '%')
            ->orWhere('goods_code', 'like', '%' . $search . '%')
            ->orWhere('goods_usage', 'like', '%' . $search . '%')
            ->orWhere('goods_specification', 'like', '%' . $search . '%')  
            ->orWhere('goods_price', 'like', '%' . $search . '%');
        })
        ->where('goods_soft_delete', 0)
        ->orderBy('goods_created_at', 'desc')
        ->paginate(15);

        return view('backend.pages.goods.index', [
            'barang' => $listdata,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $this->checkAuthorization(auth()->user(), ['goods.view']);
        $model = $this->model
        ->leftjoin('brand', 'brand.brand_code', '=', 'goods.brand_code')
        ->leftjoin('uom', 'uom.uom_code', '=', 'goods.uom_code')
        ->leftjoin('product_divisions', 'product_divisions.product_divisions_code', '=', 'goods.product_division_code')
        ->leftjoin('product_category', 'product_category.product_category_code', '=', 'goods.product_category_code')
        ->find($id);
        return $model;
    }

    public function store(Request $request)
    {
        $this->checkAuthorization(auth()->user(), ['goods.create']);
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
                'column' => $validator->errors()->keys()[0],
			];
			return response()->json($messages);
		}

        // Upload file foto
		$newFileName1 = null;
		if ($request->hasFile('goods_photo')) {
			$file1 = $request->file('goods_photo');
			$newFileName1 = 'Goods_Image_' . time() . '_' . uniqid() . '.' . $file1->getClientOriginalExtension();
			$file1->move(public_path('file_goods'), $newFileName1);
		}

        $result = $this->model->create([
            'goods_code' => $this->setcode($this->model->count() + 1, 'GDS', 6), // (@nomor_urut, @kode, @panjang_kode)
            'goods_name' => $request->goods_name, 
            'goods_photo' => $newFileName1 ? 'file_goods/' . $newFileName1 : null,
            'goods_usage' => $request->goods_usage, 
            'goods_specification' => $request->goods_specification, 
            'brand_code' => $request->brand_code, 
            'goods_price' => $request->goods_price, 
            'goods_stock' => $request->goods_stock, 
            'goods_end_user_margin' => $request->goods_end_user_margin, 
            'goods_contractor_margin' => $request->goods_contractor_margin, 
            'goods_reseller_margin' => $request->goods_reseller_margin, 
            'goods_pricelist_margon' => $request->goods_pricelist_margon, 
            'goods_end_user_price' => $request->goods_end_user_price, 
            'goods_contractor_price' => $request->goods_contractor_price, 
            'goods_reseller_price' => $request->goods_reseller_price, 
            'goods_pricelist_price' => $request->goods_pricelist_price, 
            'uom_code' => $request->uom_code, 
            'goods_weight' => $request->goods_weight, 
            'product_division_code' => $request->product_division_code, 
            'product_category_code' => $request->product_category_code, 
            'goods_availability' => $request->goods_availability, 
            'goods_notes' => $request->goods_notes, 
            'goods_created_at' => date("Y-m-d h:i:s"),
            'goods_created_by' => Session::get('user_code'),
        ]);

        session()->flash('success', __('Level has been created.'));
        return $request;
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization(auth()->user(), ['goods.edit']);

        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

		if ($validator->fails()) {
			$messages = [
				'data' => $validator->errors()->first(),
				'status' => 401,
                'column' => $validator->errors()->keys()[0],
			];
			return response()->json($messages);
		}

        $result = [
            'goods_name' => $request->goods_name, 
            // 'goods_photo' => $request->goods_photo, 
            'goods_usage' => $request->goods_usage, 
            'goods_specification' => $request->goods_specification, 
            'brand_code' => $request->brand_code, 
            'goods_price' => $request->goods_price, 
            'goods_stock' => $request->goods_stock, 
            'goods_end_user_margin' => $request->goods_end_user_margin, 
            'goods_contractor_margin' => $request->goods_contractor_margin, 
            'goods_reseller_margin' => $request->goods_reseller_margin, 
            'goods_pricelist_margon' => $request->goods_pricelist_margon, 
            'goods_end_user_price' => $request->goods_end_user_price, 
            'goods_contractor_price' => $request->goods_contractor_price, 
            'goods_reseller_price' => $request->goods_reseller_price, 
            'goods_pricelist_price' => $request->goods_pricelist_price, 
            'uom_code' => $request->uom_code, 
            'goods_weight' => $request->goods_weight, 
            'product_division_code' => $request->product_division_code, 
            'product_category_code' => $request->product_category_code, 
            'goods_availability' => $request->goods_availability, 
            'goods_notes' => $request->goods_notes, 
            'goods_updated_at' => date("Y-m-d h:i:s"),
            'goods_updated_by' => Session::get('user_code'),
        ];

        if ($request->hasFile('goods_photo')) {
			$file1 = $request->file('goods_photo');
			$newFileName1 = 'Goods_Image_' . time() . '_' . uniqid() . '.' . $file1->getClientOriginalExtension();
			$file1->move(public_path('file_goods'), $newFileName1);
			$result['goods_photo'] = 'file_goods/' . $newFileName1;
		}

        // Update data di database
		$resultdata = $this->model->find($id)->update($result);

        session()->flash('success', 'Level has been updated.');
        return $request;
    }

    public function destroy($id)
    {
        $this->checkAuthorization(auth()->user(), ['goods.delete']);

        $result = $this->model->find($id)->update([
            'goods_deleted_at' => date("Y-m-d h:i:s"),
            'goods_deleted_by' => Session::get('user_code'),
            'goods_soft_delete' => 1,
        ]);
        session()->flash('success', 'goods has been deleted.');
        return $result;
    }
}
