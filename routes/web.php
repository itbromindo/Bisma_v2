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

// Route::get('/', function () {
//     return view('welcome');
// });

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
    Route::resource('admins', AdminsController::class);
    Route::resource('users', UsersController::class);
    Route::any('users/{id}', [UsersController::class, 'update']);
    Route::resource('moduls', ModulsController::class);
    Route::any('moduls/{id}', [ModulsController::class, 'update']);
    Route::get('combomodul', [ModulsController::class, 'combo']);
    Route::resource('menus', MenusController::class);
    Route::any('menus/{id}', [MenusController::class, 'update']);
    Route::get('combomenu', [MenusController::class, 'combo']);
    Route::resource('submenus', SubmenusController::class);
    Route::any('submenus/{id}', [SubmenusController::class, 'update']);
    Route::resource('levels', LevelsController::class);
    Route::any('levels/{id}', [LevelsController::class, 'update']);

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
})->middleware('auth:admin');