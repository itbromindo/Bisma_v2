<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionSeeder.
 *
 * @see https://spatie.be/docs/laravel-permission/v5/basic-usage/multiple-guards
 *
 * @package App\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission List as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],
            [
                'group_name' => 'User',
                'permissions' => [
                    'users.create',
                    'users.view',
                    'users.edit',
                    'users.delete',
                    'users.update',
                ]
            ],
            [
                'group_name' => 'Modul',
                'permissions' => [
                    'moduls.create',
                    'moduls.view',
                    'moduls.edit',
                    'moduls.delete',
                    'moduls.update',
                ]
            ],
            [
                'group_name' => 'Menu',
                'permissions' => [
                    'menus.create',
                    'menus.view',
                    'menus.edit',
                    'menus.delete',
                    'menus.update',
                ]
            ],
            [
                'group_name' => 'Submenu',
                'permissions' => [
                    'submenus.create',
                    'submenus.view',
                    'submenus.edit',
                    'submenus.delete',
                    'submenus.update',
                ]
            ],
            [
                'group_name' => 'Level',
                'permissions' => [
                    'levels.create',
                    'levels.view',
                    'levels.edit',
                    'levels.delete',
                    'levels.update',
                ]
            ],
            [
                'group_name' => 'Company',
                'permissions' => [
                    'companies.create',
                    'companies.view',
                    'companies.edit',
                    'companies.delete',
                    'companies.update',
                ]
            ],
            [
                'group_name' => 'Division',
                'permissions' => [
                    'divisions.create',
                    'divisions.view',
                    'divisions.edit',
                    'divisions.delete',
                    'divisions.update',
                ]
            ],
            [
                'group_name' => 'Department',
                'permissions' => [
                    'department.create',
                    'department.view',
                    'department.edit',
                    'department.delete',
                    'department.update',
                ]
            ],
            [
                'group_name' => 'Homebase',
                'permissions' => [
                    'homebases.create',
                    'homebases.view',
                    'homebases.edit',
                    'homebases.delete',
                    'homebases.update',
                ]
            ],
            [
                'group_name' => 'Shift',
                'permissions' => [
                    'shifts.create',
                    'shifts.view',
                    'shifts.edit',
                    'shifts.delete',
                    'shifts.update',
                ]
            ],
            [
                'group_name' => 'Master Approval',
                'permissions' => [
                    'master_approvals.create',
                    'master_approvals.view',
                    'master_approvals.edit',
                    'master_approvals.delete',
                    'master_approvals.update',
                ]
            ],
            [
                'group_name' => 'Province',
                'permissions' => [
                    'provinces.create',
                    'provinces.view',
                    'provinces.edit',
                    'provinces.delete',
                    'provinces.update',
                ]
            ],
            [
                'group_name' => 'City',
                'permissions' => [
                    'cities.create',
                    'cities.view',
                    'cities.edit',
                    'cities.delete',
                    'cities.update',
                ]
            ],
            [
                'group_name' => 'District',
                'permissions' => [
                    'districts.create',
                    'districts.view',
                    'districts.edit',
                    'districts.delete',
                    'districts.update',
                ]
            ],
            [
                'group_name' => 'goods',
                'permissions' => [
                    'goods.create',
                    'goods.view',
                    'goods.edit',
                    'goods.delete',
                    'goods.update',
                ]
            ],
            [
                'group_name' => 'product_divisions',
                'permissions' => [
                    'product_divisions.create',
                    'product_divisions.view',
                    'product_divisions.edit',
                    'product_divisions.delete',
                    'product_divisions.update',
                ]
            ],
            [
                'group_name' => 'product_category',
                'permissions' => [
                    'product_category.create',
                    'product_category.view',
                    'product_category.edit',
                    'product_category.delete',
                    'product_category.update',
                ]
            ],
            [
                'group_name' => 'brand',
                'permissions' => [
                    'brand.create',
                    'brand.view',
                    'brand.edit',
                    'brand.delete',
                    'brand.update',
                ]
            ],
            [
                'group_name' => 'uom',
                'permissions' => [
                    'uom.create',
                    'uom.view',
                    'uom.edit',
                    'uom.delete',
                    'uom.update',
                ]
            ],
            [
                'group_name' => 'warehouse',
                'permissions' => [
                    'warehouse.create',
                    'warehouse.view',
                    'warehouse.edit',
                    'warehouse.delete',
                    'warehouse.update',
                ]
            ],
            [
                'group_name' => 'customer',
                'permissions' => [
                    'customer.create',
                    'customer.view',
                    'customer.edit',
                    'customer.delete',
                    'customer.update',
                ]
            ],
            [
                'group_name' => 'customer_category',
                'permissions' => [
                    'customer_category.create',
                    'customer_category.view',
                    'customer_category.edit',
                    'customer_category.delete',
                    'customer_category.update',
                ]
            ],
            [
                'group_name' => 'company_type',
                'permissions' => [
                    'company_type.create',
                    'company_type.view',
                    'company_type.edit',
                    'company_type.delete',
                    'company_type.update',
                ]
            ],
        ];

        // Do same for the admin guard for tutorial purposes.
        $admin = User::where('user_code', 'admin1')->first();
        $roleSuperAdmin = $this->maybeCreateSuperAdminRole($admin);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permissionExist = Permission::where('name', $permissions[$i]['permissions'][$j])->first();
                if (is_null($permissionExist)) {
                    $permission = Permission::create(
                        [
                            'name' => $permissions[$i]['permissions'][$j],
                            'group_name' => $permissionGroup,
                            'guard_name' => 'web'
                        ]
                    );
                    $roleSuperAdmin->givePermissionTo($permission);
                    $permission->assignRole($roleSuperAdmin);
                }
            }
        }

        // Assign super admin role permission to superadmin user
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }

    private function maybeCreateSuperAdminRole($admin): Role
    {
        if (is_null($admin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);
        } else {
            $roleSuperAdmin = Role::where('name', 'superadmin')->where('guard_name', 'web')->first();
        }

        if (is_null($roleSuperAdmin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);
        }

        return $roleSuperAdmin;
    }
}
