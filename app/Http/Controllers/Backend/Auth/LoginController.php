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

            $main = $this->modelmodul->where('moduls_soft_delete', 0)->get();
            $return = [];
            foreach ($main as $val) {
                $menu = $this->modelmenu->where('moduls_code', $val->moduls_code)->get();
                $return2 = []; 
                foreach ($menu as $valmenu) {
                    $return2[] = array(
                        'menu_name' => $valmenu->menus_name,
                        'menu_route' => $valmenu->menus_route,
                    );
                }
                $return[] = array(
                    'modul_name' => $val->moduls_name,
                    'modul_icon' => $val->moduls_icon,
                    'modul_menu' => $return2
                );
            }
            Session::put('menu', $return);

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
        session()->forget(['user_code', 'user_name', 'menu']);
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
}
