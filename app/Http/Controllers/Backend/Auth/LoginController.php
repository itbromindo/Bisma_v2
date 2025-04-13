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
use Hamcrest\Core\Set;

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

            $code_homebase = DB::table('homebases')
                ->select('homebase_name')
                ->where('homebase_code', $user->users_homebase)
                ->first();
            $homebase_name = $code_homebase->homebase_name ?? null;

            Session::put('user_code', $user->user_code);
            Session::put('user_name', $user->users_name);
            Session::put('permission', $user->users_permission);
            Session::put('homebase_code', $user->users_homebase);
            Session::put('homebase_name', $homebase_name);
            Session::put('date_now', date('Y-m-d'));
            Session::put('time_now', date('H:i:s'));
            Session::put('date_indo_format',$this->date_indo(date('Y-m-d')));

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
        session()->forget(['user_code', 'user_name', 'user_id', 'permission','homebase_code','homebase_name','date_now','time_now','date_indo_format']);
        // session()->flush();
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }

    public function date_indo($date){
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
    
        $tanggal = date('d', strtotime($date));
        $bulanIndex = (int)date('m', strtotime($date));
        $tahun = date('Y', strtotime($date));
    
        return $tanggal . ' ' . $bulan[$bulanIndex] . ' ' . $tahun;
    }
}
