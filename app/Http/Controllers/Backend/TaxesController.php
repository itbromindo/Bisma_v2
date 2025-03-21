<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Taxes;

class TaxesController extends Controller
{
    public function __construct()
    {
        $this->model = new Taxes();
        // $this->mandatory = array(
        //     '' => '',
		// );
    }

    public function index(Request $request)
    {        
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function combo(Request $request)
    {
        $search = !empty($_GET['search']) ? $_GET['search'] : '%';

        $listdata = $this->model
            ->select('taxes_code as id', 'taxes_name as text')
            ->where('taxes_name', 'like', '%' . $search . '%')
            ->where('taxes_soft_delete', 0)
            ->get();

        return response()->json($listdata);
    }
}
