<?php

use App\Http\Controllers\Backend\ChecklistController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\DecissionQuotationController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\DescriptionQuotationController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\HomebaseController;
use App\Http\Controllers\Backend\InquiryGoodController;
use App\Http\Controllers\Backend\InquiryStatusController;
use App\Http\Controllers\Backend\MasterApprovalController;
use App\Http\Controllers\Backend\OriginInquiryController;
use App\Http\Controllers\Backend\ParameterDuedateController;
use App\Http\Controllers\Backend\OptionChecklistController;
use App\Http\Controllers\Backend\PillarController;
use App\Http\Controllers\Backend\ProvinceController;
use App\Http\Controllers\Backend\QuotationStatusController;
use App\Http\Controllers\Backend\ShiftController;
use App\Models\InquiryGood;
use App\Models\OriginInquiry;
use App\Http\Controllers\Backend\TemplateWinLoseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\ModulsController;
use App\Http\Controllers\Backend\MenusController;
use App\Http\Controllers\Backend\SubmenusController;
use App\Http\Controllers\Backend\LevelsController;
use App\Http\Controllers\Backend\PendudukController;
use App\Http\Controllers\Backend\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');


/**
 * Admin routes
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RolesController::class);
    Route::resource('permission', RolesController::class);
    Route::get('comboroles', [RolesController::class, 'combo']);
    Route::resource('admins', AdminsController::class);

    // User Routes
    Route::resource('users', UsersController::class);
    Route::any('users/{id}', [UsersController::class, 'update']);

    // Modul Routes
    Route::resource('moduls', ModulsController::class);
    Route::any('moduls/{id}', [ModulsController::class, 'update']);
    Route::get('combomodul', [ModulsController::class, 'combo']);

    // Menu Routes
    Route::resource('menus', MenusController::class);
    Route::any('menus/{id}', [MenusController::class, 'update']);
    Route::get('combomenu', [MenusController::class, 'combo']);

    // Submenu Routes
    Route::resource('submenus', SubmenusController::class);
    Route::any('submenus/{id}', [SubmenusController::class, 'update']);

    // Level Routes
    Route::resource('levels', LevelsController::class);
    Route::any('levels/{id}', [LevelsController::class, 'update']);
    Route::get('combolevels', [LevelsController::class, 'combo']);

    // Login Routes.
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('login.submit');

    // Logout Routes.
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');

    // Forget Password Routes.
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('password.update');

    Route::get('penduduk/importexcel', [PendudukController::class, 'importExcel'])->name('penduduk.importexcel');
    Route::post('penduduk/import', [PendudukController::class, 'import'])->name('penduduk.import');
    Route::get('penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
    Route::resource('penduduk', PendudukController::class);

    // Company routes
    Route::resource('companies', CompanyController::class);
    Route::any('companies/{id}', [CompanyController::class, 'update']);
    Route::get('combocompanies', [CompanyController::class, 'combo']);

    // Division routes
    Route::resource('divisions', DivisionController::class);
    Route::any('divisions/{id}', [DivisionController::class, 'update']);
    Route::get('combodivisions', [DivisionController::class, 'combo']);

    // Department Routes
    Route::resource('departments', DepartmentController::class);
    Route::any('departments/{id}', [DepartmentController::class, 'update']);
    Route::get('combodepartments', [App\Http\Controllers\Backend\DepartmentController::class, 'combo']);
    
    // Homebase Routes
    Route::resource('homebases', HomebaseController::class);
    Route::any('homebases/{id}', [HomebaseController::class, 'update']);
    Route::get('combohomebases', [HomebaseController::class, 'combo']);

    // Shift Routes
    Route::resource('shifts', ShiftController::class);
    Route::any('shifts/{id}', [ShiftController::class, 'update']);
    Route::get('comboshifts', [ShiftController::class, 'combo']);

    // Master Approval Routes
    Route::resource('master_approvals', MasterApprovalController::class);
    Route::any('master_approvals/{id}', [MasterApprovalController::class, 'update']);

    //Province Routes
    Route::resource('provinces', ProvinceController::class);
    Route::any('provinces/{id}', [ProvinceController::class, 'update']);
    Route::get('comboprovinces', [App\Http\Controllers\Backend\ProvinceController::class, 'combo']);
    
    //City Routes
    Route::resource('cities', CityController::class);
    Route::any('cities/{id}', [CityController::class, 'update']);
    Route::get('combocities', [App\Http\Controllers\Backend\CityController::class, 'combo']);

    //District Routes
    Route::resource('districts', DistrictController::class);
    Route::any('districts/{id}', [DistrictController::class, 'update']);
    Route::get('combodistricts', [App\Http\Controllers\Backend\DistrictController::class, 'combo']);

    // Goods Routes
    Route::resource('goods', App\Http\Controllers\Backend\GoodsController::class);
    Route::any('goods/{id}', [App\Http\Controllers\Backend\GoodsController::class, 'update']);

    // product_divisions
    Route::resource('product_divisions', App\Http\Controllers\Backend\ProductdivisionController::class);
    Route::any('product_divisions/{id}', [App\Http\Controllers\Backend\ProductdivisionController::class, 'update']);
    Route::get('comboproductdivision', [App\Http\Controllers\Backend\ProductdivisionController::class, 'combo']);

    // product_category
    Route::resource('product_category', App\Http\Controllers\Backend\ProductcategoryController::class);
    Route::any('product_category/{id}', [App\Http\Controllers\Backend\ProductcategoryController::class, 'update']);
    Route::get('combokategori', [App\Http\Controllers\Backend\ProductcategoryController::class, 'combo']);

    // brand
    Route::resource('brand', App\Http\Controllers\Backend\BrandController::class);
    Route::any('brand/{id}', [App\Http\Controllers\Backend\BrandController::class, 'update']);
    Route::get('combobrand', [App\Http\Controllers\Backend\BrandController::class, 'combo']);

    // uom
    Route::resource('uom', App\Http\Controllers\Backend\UomController::class);
    Route::any('uom/{id}', [App\Http\Controllers\Backend\UomController::class, 'update']);
    Route::get('combosatuan', [App\Http\Controllers\Backend\UomController::class, 'combo']);

    // warehouse
    Route::resource('warehouse', App\Http\Controllers\Backend\WarehouseController::class);
    Route::any('warehouse/{id}', [App\Http\Controllers\Backend\WarehouseController::class, 'update']);

    // customer
    Route::resource('customer', App\Http\Controllers\Backend\CustomerController::class);
    Route::any('customer/{id}', [App\Http\Controllers\Backend\CustomerController::class, 'update']);

    // customer_category
    Route::resource('customer_category', App\Http\Controllers\Backend\CustomercategoryController::class);
    Route::any('customer_category/{id}', [App\Http\Controllers\Backend\CustomercategoryController::class, 'update']);
    Route::get('combokategoricustomer', [App\Http\Controllers\Backend\CustomercategoryController::class, 'combo']);

    // company_type
    Route::resource('company_type', App\Http\Controllers\Backend\CompanytypeController::class);
    Route::any('company_type/{id}', [App\Http\Controllers\Backend\CompanytypeController::class, 'update']);

    
    //Inquiry Good Routes
    Route::resource('inquiry_goods', InquiryGoodController::class);
    Route::any('inquiry_goods/{id}', [InquiryGoodController::class, 'update']);
    
    //Origin Inquiry Routes
    Route::resource('origin_inquiries', OriginInquiryController::class);
    Route::any('origin_inquiries/{id}', [OriginInquiryController::class, 'update']);
    
    //Description Quotation Routes
    Route::resource('description_quotations', DescriptionQuotationController::class);
    Route::any('description_quotations/{id}', [DescriptionQuotationController::class, 'update']);
    
    //Origin Parameter Duedate Routes
    Route::resource('parameter_duedates', ParameterDuedateController::class);
    Route::any('parameter_duedates/{id}', [ParameterDuedateController::class, 'update']);
    
    //Decission Quotation Routes
    Route::resource('decission_quotations', DecissionQuotationController::class);
    Route::any('decission_quotations/{id}', [DecissionQuotationController::class, 'update']);
    
    //Quotation Status Routes
    Route::resource('quotation_statuses', QuotationStatusController::class);
    Route::any('quotation_statuses/{id}', [QuotationStatusController::class, 'update']);
   
    Route::resource('pillars', PillarController::class);
    Route::any('pillars/{id}', [PillarController::class, 'update']);

    Route::resource('pillars', PillarController::class);
    Route::any('pillars/{id}', [PillarController::class, 'update']);
    
    Route::resource('checklists', ChecklistController::class);
    Route::any('checklists/{id}', [ChecklistController::class, 'update']);
    
    Route::resource('optionchecklists', OptionChecklistController::class);
    Route::any('optionchecklists/{id}', [OptionChecklistController::class, 'update']);

    Route::resource('template_win_loses', TemplateWinLoseController::class);
    Route::any('template_win_loses/{id}', [TemplateWinLoseController::class, 'update']);
    
    Route::resource('inquiry_statuses', InquiryStatusController::class);
    Route::any('inquiry_statuses/{id}', [InquiryStatusController::class, 'update']);
})->middleware('auth:admin');
