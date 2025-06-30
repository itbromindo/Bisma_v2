<?php
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
use App\Http\Controllers\Backend\Inquiry\InquiryController;

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
    Route::get('combousers', [UsersController::class, 'combo']);

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
    Route::resource('companies', App\Http\Controllers\Backend\CompanyController::class);
    Route::any('companies/{id}', [App\Http\Controllers\Backend\CompanyController::class, 'update']);
    Route::get('combocompanies', [App\Http\Controllers\Backend\CompanyController::class, 'combo']);

    // Division routes
    Route::resource('divisions', App\Http\Controllers\Backend\DivisionController::class);
    Route::any('divisions/{id}', [App\Http\Controllers\Backend\DivisionController::class, 'update']);
    Route::get('combodivisions', [App\Http\Controllers\Backend\DivisionController::class, 'combo']);

    // Department Routes
    Route::resource('departments', App\Http\Controllers\Backend\DepartmentController::class);
    Route::any('departments/{id}', [App\Http\Controllers\Backend\DepartmentController::class, 'update']);
    Route::get('combodepartments', [App\Http\Controllers\Backend\DepartmentController::class, 'combo']);
    
    // Homebase Routes
    Route::resource('homebases', App\Http\Controllers\Backend\HomebaseController::class);
    Route::any('homebases/{id}', [App\Http\Controllers\Backend\HomebaseController::class, 'update']);
    Route::get('combohomebases', [App\Http\Controllers\Backend\HomebaseController::class, 'combo']);

    // Shift Routes
    Route::resource('shifts', App\Http\Controllers\Backend\ShiftController::class);
    Route::any('shifts/{id}', [App\Http\Controllers\Backend\ShiftController::class, 'update']);
    Route::get('comboshifts', [App\Http\Controllers\Backend\ShiftController::class, 'combo']);

    // Master Approval Routes
    Route::resource('master_approvals', App\Http\Controllers\Backend\MasterApprovalController::class);

    //Province Routes
    Route::resource('provinces', App\Http\Controllers\Backend\ProvinceController::class);
    Route::any('provinces/{id}', [App\Http\Controllers\Backend\ProvinceController::class, 'update']);
    Route::get('comboprovinces', [App\Http\Controllers\Backend\ProvinceController::class, 'combo']);
    
    //City Routes
    Route::resource('cities', App\Http\Controllers\Backend\CityController::class);
    Route::any('cities/{id}', [App\Http\Controllers\Backend\CityController::class, 'update']);
    Route::get('combocities', [App\Http\Controllers\Backend\CityController::class, 'combo']);

    //District Routes
    Route::resource('districts', App\Http\Controllers\Backend\DistrictController::class);
    Route::any('districts/{id}', [App\Http\Controllers\Backend\DistrictController::class, 'update']);
    Route::get('combodistricts', [App\Http\Controllers\Backend\DistrictController::class, 'combo']);

    // Goods Routes
    Route::resource('goods', App\Http\Controllers\Backend\GoodsController::class);
    Route::any('goods/{id}', [App\Http\Controllers\Backend\GoodsController::class, 'update']);
    Route::get('combogoods', [App\Http\Controllers\Backend\GoodsController::class, 'combo']);

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
    Route::get('combowarehouse', [App\Http\Controllers\Backend\WarehouseController::class, 'combo']);

    // customer
    Route::resource('customer', App\Http\Controllers\Backend\CustomerController::class);
    Route::any('customer/{id}', [App\Http\Controllers\Backend\CustomerController::class, 'update']);
    Route::any('combocustomer', [App\Http\Controllers\Backend\CustomerController::class, 'combo']);

    // customer_category
    Route::resource('customer_category', App\Http\Controllers\Backend\CustomercategoryController::class);
    Route::any('customer_category/{id}', [App\Http\Controllers\Backend\CustomercategoryController::class, 'update']);
    Route::get('combokategoricustomer', [App\Http\Controllers\Backend\CustomercategoryController::class, 'combo']);

    // company_type
    Route::resource('company_type', App\Http\Controllers\Backend\CompanytypeController::class);
    Route::any('company_type/{id}', [App\Http\Controllers\Backend\CompanytypeController::class, 'update']);

    
    //Inquiry Good Routes
    Route::resource('inquiry_goods', App\Http\Controllers\Backend\InquiryGoodController::class);
    Route::any('inquiry_goods/{id}', [App\Http\Controllers\Backend\InquiryGoodController::class, 'update']);
    
    //Origin Inquiry Routes
    Route::resource('origin_inquiries', App\Http\Controllers\Backend\OriginInquiryController::class);
    Route::any('origin_inquiries/{id}', [App\Http\Controllers\Backend\OriginInquiryController::class, 'update']);
    Route::get('comboorigininquiries', [App\Http\Controllers\Backend\OriginInquiryController::class, 'combo']);
    
    //Description Quotation Routes
    Route::resource('description_quotations', App\Http\Controllers\Backend\DescriptionQuotationController::class);
    Route::any('description_quotations/{id}', [App\Http\Controllers\Backend\DescriptionQuotationController::class, 'update']);
    
    //Origin Parameter Duedate Routes
    Route::resource('parameter_duedates', App\Http\Controllers\Backend\ParameterDuedateController::class);
    Route::any('parameter_duedates/{id}', [App\Http\Controllers\Backend\ParameterDuedateController::class, 'update']);
    
    //Decission Quotation Routes
    Route::resource('decission_quotations', App\Http\Controllers\Backend\DecissionQuotationController::class);
    Route::any('decission_quotations/{id}', [App\Http\Controllers\Backend\DecissionQuotationController::class, 'update']);
    
    //Quotation Status Routes
    Route::resource('quotation_statuses', App\Http\Controllers\Backend\QuotationStatusController::class);
    Route::any('quotation_statuses/{id}', [App\Http\Controllers\Backend\QuotationStatusController::class, 'update']);

    Route::resource('pillars', App\Http\Controllers\Backend\PillarController::class);
    Route::any('pillars/{id}', [App\Http\Controllers\Backend\PillarController::class, 'update']);
    Route::get('combopillars', [App\Http\Controllers\Backend\PillarController::class, 'combo']);
    
    Route::resource('checklists', App\Http\Controllers\Backend\ChecklistController::class);
    Route::any('checklists/{id}', [App\Http\Controllers\Backend\ChecklistController::class, 'update']);
    Route::get('combochecklists', [App\Http\Controllers\Backend\ChecklistController::class, 'combo']);
    
    Route::resource('optionchecklists', App\Http\Controllers\Backend\OptionChecklistController::class);
    Route::any('optionchecklists/{id}', [App\Http\Controllers\Backend\OptionChecklistController::class, 'update']);

    Route::resource('template_win_loses', App\Http\Controllers\Backend\TemplateWinLoseController::class);
    Route::any('template_win_loses/{id}', [App\Http\Controllers\Backend\TemplateWinLoseController::class, 'update']);
    
    Route::resource('inquiry_statuses', App\Http\Controllers\Backend\InquiryStatusController::class);
    Route::any('inquiry_statuses/{id}', [App\Http\Controllers\Backend\InquiryStatusController::class, 'update']);

    Route::prefix('inquiry')->controller(InquiryController::class)->group(function () {
        Route::get('/', 'index')->name('inquiry');
        Route::get('/update_stage', 'update_stage');
        Route::get('/cancel_stage/{id}', 'cancel_stage');
        Route::get('/detail/{id}', 'detail_inquiry');
        Route::get('/download/{id}', 'download_inquiry');
        Route::any('/back_to_sales/{id}', 'back_to_sales');
    });


    Route::post('inquiry_supply_only/previewpdf', [App\Http\Controllers\Backend\Inquiry\InquirysupplyonlyController::class, 'previewpdf']);
    Route::resource('inquiry_supply_only', App\Http\Controllers\Backend\Inquiry\InquirysupplyonlyController::class);
    Route::get('inquiry_supply_only/edit/{id}', [App\Http\Controllers\Backend\Inquiry\InquirysupplyonlyController::class, 'edit_data']);
    Route::any('inquiry_supply_only/update/{id}', [App\Http\Controllers\Backend\Inquiry\InquirysupplyonlyController::class, 'update']);

    Route::get('combotaxes', [App\Http\Controllers\Backend\TaxesController::class, 'combo']);

})->middleware('auth:admin');
