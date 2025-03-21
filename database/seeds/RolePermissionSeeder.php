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
                'menu_code' => '',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'role',
                'menu_code' => 2,
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
                'menu_code' => 1,
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
                'menu_code' => 3,
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
                'menu_code' => 4,
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
                'menu_code' => 5,
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
                'menu_code' => 6,
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
                'menu_code' => 7,
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
                'menu_code' => 8,
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
                'menu_code' => 9,
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
                'menu_code' => 10,
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
                'menu_code' => 11,
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
                'menu_code' => 12,
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
                'menu_code' => 13,
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
                'menu_code' => 14,
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
                'menu_code' => 15,
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
                'menu_code' => 16,
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
                'menu_code' => 17,
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
                'menu_code' => 18,
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
                'menu_code' => 19,
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
                'menu_code' => 20,
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
                'menu_code' => 21,
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
                'menu_code' => 22,
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
                'menu_code' => 23,
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
                'menu_code' => 24,
                'permissions' => [
                    'company_type.create',
                    'company_type.view',
                    'company_type.edit',
                    'company_type.delete',
                    'company_type.update',
                ]
            ],
            [
                'group_name' => 'Inquiry Good',
                'menu_code' => 25,
                'permissions' => [
                    'inquiry_goods.create',
                    'inquiry_goods.view',
                    'inquiry_goods.edit',
                    'inquiry_goods.delete',
                    'inquiry_goods.update',
                ]
            ],
            [
                'group_name' => 'Origin Inquiry',
                'menu_code' => 26,
                'permissions' => [
                    'origin_inquiries.create',
                    'origin_inquiries.view',
                    'origin_inquiries.edit',
                    'origin_inquiries.delete',
                    'origin_inquiries.update',
                ]
            ],
            [
                'group_name' => 'Pillar',
                'menu_code' => 27,
                'permissions' => [
                    'pillars.create',
                    'pillars.view',
                    'pillars.edit',
                    'pillars.delete',
                    'pillars.update',
                ]
            ],
            [
                'group_name' => 'Checklist',
                'menu_code' => 28,
                'permissions' => [
                    'checklists.create',
                    'checklists.view',
                    'checklists.edit',
                    'checklists.delete',
                    'checklists.update',
                ]
            ],
            [
                'group_name' => 'Option Checklist',
                'menu_code' => 29,
                'permissions' => [
                    'optionchecklists.create',
                    'optionchecklists.view',
                    'optionchecklists.edit',
                    'optionchecklists.delete',
                    'optionchecklists.update',
                ]
            ],
            [
                'group_name' => 'Template Win Or Loses',
                'menu_code' => 30,
                'permissions' => [
                    'template_win_loses.create',
                    'template_win_loses.view',
                    'template_win_loses.edit',
                    'template_win_loses.delete',
                    'template_win_loses.update',
                ]
            ],
            [
                'group_name' => 'Inquiry Status',
                'menu_code' => 31,
                'permissions' => [
                    'inquiry_statuses.create',
                    'inquiry_statuses.view',
                    'inquiry_statuses.edit',
                    'inquiry_statuses.delete',
                    'inquiry_statuses.update',
                ]
            ],
            [
                'group_name' => 'Parameter Duedate',
                'menu_code' => 32,
                'permissions' => [
                    'parameter_duedate.create',
                    'parameter_duedate.view',
                    'parameter_duedate.edit',
                    'parameter_duedate.delete',
                    'parameter_duedate.update',
                ]
            ],
            [
                'group_name' => 'Decission Quotation',
                'menu_code' => 33,
                'permissions' => [
                    'decission_quotation.create',
                    'decission_quotation.view',
                    'decission_quotation.edit',
                    'decission_quotation.delete',
                    'decission_quotation.update',
                ]
            ],
            [
                'group_name' => 'Quotation Status',
                'menu_code' => 34,
                'permissions' => [
                    'quotation_statuses.create',
                    'quotation_statuses.view',
                    'quotation_statuses.edit',
                    'quotation_statuses.delete',
                    'quotation_statuses.update',
                ]
            ],
            [
                'group_name' => 'Description Quotation',
                'menu_code' => 35,
                'permissions' => [
                    'description_quotations.create',
                    'description_quotations.view',
                    'description_quotations.edit',
                    'description_quotations.delete',
                    'description_quotations.update',
                ]
            ],
            
            [
                'group_name' => 'Inquiry',
                'menu_code' => 36,
                'permissions' => [
                    'inquiry.create',
                    'inquiry.view',
                    'inquiry.edit',
                    'inquiry.delete',
                    'inquiry.update',
                ]
            ],
        ];

        // Do same for the admin guard for tutorial purposes.
        $admin = User::where('user_code', 'admin1')->first();
        $roleSuperAdmin = $this->maybeCreateSuperAdminRole($admin);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            $menucode = $permissions[$i]['menu_code'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permissionExist = Permission::where('name', $permissions[$i]['permissions'][$j])->first();
                if (is_null($permissionExist)) {
                    $permission = Permission::create(
                        [
                            'name' => $permissions[$i]['permissions'][$j],
                            'group_name' => $permissionGroup,
                            'guard_name' => 'web',
                            'menu_code' => $menucode,
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
