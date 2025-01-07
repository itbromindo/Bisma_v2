<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\AuthorizationChecker;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Session;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, AuthorizationChecker;

    public function __construct()
    {
        view()->composer('sidebar', function ($view) {
            $menuData = $this->getsetmenu();
            $view->with('menuData', $menuData);
        });
    }

    public function setcode($nomor,$leftcode,$lengthcode)
    {
        $code = $leftcode . str_pad((string)$nomor, $lengthcode, '0', STR_PAD_LEFT);
        return $code;
    }

    public function getsetmenu(){
        $user = Session::get('permission');

        $roles = DB::table('roles')
                ->where('name', $user)
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

        return $show;
    }
}
