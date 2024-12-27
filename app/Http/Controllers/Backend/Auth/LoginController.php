<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Moduls;
use App\Models\Menus;
use App\Models\Submenus;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function __construct()
    {
        $this->modelmodul = new Moduls();
        $this->modelmenu = new Menus();
        $this->modelsubmenu = new Submenus();
        // $this->modeluser = new User();
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * show login form for admin guard
     *
     * @return void
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }


    /**
     * login admin
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|max:50',
            'password' => 'required',
        ]);

        // Coba login dengan email
        if (Auth::attempt(['users_email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::user();

            Session::put('user_code', $user->user_code);
            Session::put('user_name', $user->users_name);

            $roles = DB::table('roles')
                ->where('name', $user->users_permission)
                ->first();

            $permissions = DB::table('role_has_permissions')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id') // Gunakan INNER JOIN
                ->join('menus', 'permissions.menu_code', '=', 'menus.menus_id') // Gunakan INNER JOIN
                ->join('moduls', 'menus.moduls_code', '=', 'moduls.moduls_code') // Gunakan INNER JOIN
                ->where('role_has_permissions.role_id', $roles->id)
                ->where('permissions.name', 'like', '%.view')
                ->where('permissions.name', '!=', 'dashboard.view')
                ->groupBy('moduls.moduls_code', 'moduls.moduls_name', 'moduls.moduls_icon')
                ->select(
                    'moduls.moduls_code',
                    'moduls.moduls_name',
                    'moduls.moduls_icon',
                    DB::raw('COUNT(permissions.id) as permission_count')
                )
                ->get();
            $show = [];
            foreach ($permissions as $val) {
                $menushow = DB::table('role_has_permissions')
                    ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->join('menus', 'permissions.menu_code', '=', 'menus.menus_id')
                    ->where('permissions.name', 'like', '%.view')
                    ->where('role_has_permissions.role_id', $roles->id)
                    ->where('menus.moduls_code', $val->moduls_code)
                    ->groupBy('menus.menus_code', 'menus.menus_name', 'menus.menus_route')
                    ->select(
                        'menus.menus_code',
                        'menus.menus_name',
                        'menus.menus_route',
                        DB::raw('COUNT(permissions.id) as permission_count')
                    )
                    ->get();
                $show2 = [];
                foreach ($menushow as $val2) {
                    $show2[] = [
                        // 'menu_code' => $val2->menus_code,
                        'menu_name' => $val2->menus_name,
                        'menu_route' => $val2->menus_route,
                    ];
                }
                $show[] = array(
                    'modul_name' => $val->moduls_name,
                    'modul_icon' => $val->moduls_icon,
                    'modul_menu' => $show2
                );
            }
            Session::put('menu', $show);

            session()->flash('success', 'Successully Logged in !');
            return redirect()->route('admin.dashboard');
        }

        // // Coba login dengan username
        // if (Auth::attempt(['username' => $request->email, 'password' => $request->password], $request->remember)) {
        //     session()->flash('success', 'Successfully Logged in!');
        //     return redirect()->intended($this->redirectTo);
        // }

        // Jika login gagal
        session()->flash('error', 'Invalid email or password');
        return back();
    }

    /**
     * logout admin guard
     *
     * @return void
     */
    public function logout()
    {
        // return "okok";
        session()->forget(['user_code', 'user_name', 'menu', 'menu2', 'user_id']);
        // session()->flush();
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
}
