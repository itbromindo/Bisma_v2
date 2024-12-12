<?php

use App\Models\Submenus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $submenu = [
            ['submenus_code' => '1011', 'menus_code' => '1001', 'submenus_name' => 'users.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1012', 'menus_code' => '1001', 'submenus_name' => 'users.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1013', 'menus_code' => '1001', 'submenus_name' => 'users.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1014', 'menus_code' => '1001', 'submenus_name' => 'users.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1015', 'menus_code' => '1001', 'submenus_name' => 'users.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1021', 'menus_code' => '1002', 'submenus_name' => 'role.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1022', 'menus_code' => '1002', 'submenus_name' => 'role.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1023', 'menus_code' => '1002', 'submenus_name' => 'role.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1024', 'menus_code' => '1002', 'submenus_name' => 'role.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1025', 'menus_code' => '1002', 'submenus_name' => 'role.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1031', 'menus_code' => '1003', 'submenus_name' => 'moduls.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1032', 'menus_code' => '1003', 'submenus_name' => 'moduls.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1033', 'menus_code' => '1003', 'submenus_name' => 'moduls.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1034', 'menus_code' => '1003', 'submenus_name' => 'moduls.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1035', 'menus_code' => '1003', 'submenus_name' => 'moduls.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1041', 'menus_code' => '1004', 'submenus_name' => 'menus.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1042', 'menus_code' => '1004', 'submenus_name' => 'menus.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1043', 'menus_code' => '1004', 'submenus_name' => 'menus.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1044', 'menus_code' => '1004', 'submenus_name' => 'menus.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1045', 'menus_code' => '1004', 'submenus_name' => 'menus.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1051', 'menus_code' => '1005', 'submenus_name' => 'submenus.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1052', 'menus_code' => '1005', 'submenus_name' => 'submenus.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1053', 'menus_code' => '1005', 'submenus_name' => 'submenus.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1054', 'menus_code' => '1005', 'submenus_name' => 'submenus.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1055', 'menus_code' => '1005', 'submenus_name' => 'submenus.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1061', 'menus_code' => '1006', 'submenus_name' => 'levels.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1062', 'menus_code' => '1006', 'submenus_name' => 'levels.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1063', 'menus_code' => '1006', 'submenus_name' => 'levels.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1064', 'menus_code' => '1006', 'submenus_name' => 'levels.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1065', 'menus_code' => '1006', 'submenus_name' => 'levels.update', 'submenus_notes' => '-'],
        ];

        Submenus::insert($submenu);
    }
}
