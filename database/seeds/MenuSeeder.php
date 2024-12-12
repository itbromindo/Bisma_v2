<?php

use App\Models\Menus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            ['menus_code' => '1001', 'moduls_code' => '1000', 'menus_name' => 'User', 'menus_route' => 'users', 'menus_notes' => '-'],
            ['menus_code' => '1002', 'moduls_code' => '1000', 'menus_name' => 'Perminssion', 'menus_route' => 'permission', 'menus_notes' => '-'],
            ['menus_code' => '1003', 'moduls_code' => '1000', 'menus_name' => 'Modul', 'menus_route' => 'moduls', 'menus_notes' => '-'],
            ['menus_code' => '1004', 'moduls_code' => '1000', 'menus_name' => 'Menu', 'menus_route' => 'menus', 'menus_notes' => '-'],
            ['menus_code' => '1005', 'moduls_code' => '1000', 'menus_name' => 'Submenu', 'menus_route' => 'submenus', 'menus_notes' => '-'],
            ['menus_code' => '1006', 'moduls_code' => '1000', 'menus_name' => 'Level', 'menus_route' => 'levels', 'menus_notes' => '-'],
        ];

        Menus::insert($menu);
    }
}
