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
            
            ['submenus_code' => '1071', 'menus_code' => '1007', 'submenus_name' => 'companies.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1072', 'menus_code' => '1007', 'submenus_name' => 'companies.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1073', 'menus_code' => '1007', 'submenus_name' => 'companies.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1074', 'menus_code' => '1007', 'submenus_name' => 'companies.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1075', 'menus_code' => '1007', 'submenus_name' => 'companies.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1081', 'menus_code' => '1008', 'submenus_name' => 'divisions.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1082', 'menus_code' => '1008', 'submenus_name' => 'divisions.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1083', 'menus_code' => '1008', 'submenus_name' => 'divisions.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1084', 'menus_code' => '1008', 'submenus_name' => 'divisions.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1085', 'menus_code' => '1008', 'submenus_name' => 'divisions.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1091', 'menus_code' => '1009', 'submenus_name' => 'department.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1092', 'menus_code' => '1009', 'submenus_name' => 'department.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1093', 'menus_code' => '1009', 'submenus_name' => 'department.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1094', 'menus_code' => '1009', 'submenus_name' => 'department.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1095', 'menus_code' => '1009', 'submenus_name' => 'department.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1101', 'menus_code' => '1010', 'submenus_name' => 'homebases.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1102', 'menus_code' => '1010', 'submenus_name' => 'homebases.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1103', 'menus_code' => '1010', 'submenus_name' => 'homebases.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1104', 'menus_code' => '1010', 'submenus_name' => 'homebases.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1105', 'menus_code' => '1010', 'submenus_name' => 'homebases.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1111', 'menus_code' => '1011', 'submenus_name' => 'shifts.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1112', 'menus_code' => '1011', 'submenus_name' => 'shifts.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1113', 'menus_code' => '1011', 'submenus_name' => 'shifts.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1114', 'menus_code' => '1011', 'submenus_name' => 'shifts.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1115', 'menus_code' => '1011', 'submenus_name' => 'shifts.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1121', 'menus_code' => '1012', 'submenus_name' => 'master_approvals.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1122', 'menus_code' => '1012', 'submenus_name' => 'master_approvals.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1123', 'menus_code' => '1012', 'submenus_name' => 'master_approvals.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1124', 'menus_code' => '1012', 'submenus_name' => 'master_approvals.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1125', 'menus_code' => '1012', 'submenus_name' => 'master_approvals.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1131', 'menus_code' => '1013', 'submenus_name' => 'provinces.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1132', 'menus_code' => '1013', 'submenus_name' => 'provinces.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1133', 'menus_code' => '1013', 'submenus_name' => 'provinces.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1134', 'menus_code' => '1013', 'submenus_name' => 'provinces.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1135', 'menus_code' => '1013', 'submenus_name' => 'provinces.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1141', 'menus_code' => '1014', 'submenus_name' => 'cities.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1142', 'menus_code' => '1014', 'submenus_name' => 'cities.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1143', 'menus_code' => '1014', 'submenus_name' => 'cities.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1144', 'menus_code' => '1014', 'submenus_name' => 'cities.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1145', 'menus_code' => '1014', 'submenus_name' => 'cities.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1151', 'menus_code' => '1015', 'submenus_name' => 'districts.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1152', 'menus_code' => '1015', 'submenus_name' => 'districts.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1153', 'menus_code' => '1015', 'submenus_name' => 'districts.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1154', 'menus_code' => '1015', 'submenus_name' => 'districts.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1155', 'menus_code' => '1015', 'submenus_name' => 'districts.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1161', 'menus_code' => '1016', 'submenus_name' => 'goods.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1162', 'menus_code' => '1016', 'submenus_name' => 'goods.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1163', 'menus_code' => '1016', 'submenus_name' => 'goods.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1164', 'menus_code' => '1016', 'submenus_name' => 'goods.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1165', 'menus_code' => '1016', 'submenus_name' => 'goods.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1171', 'menus_code' => '1017', 'submenus_name' => 'product_divisions.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1172', 'menus_code' => '1017', 'submenus_name' => 'product_divisions.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1173', 'menus_code' => '1017', 'submenus_name' => 'product_divisions.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1174', 'menus_code' => '1017', 'submenus_name' => 'product_divisions.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1175', 'menus_code' => '1017', 'submenus_name' => 'product_divisions.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1181', 'menus_code' => '1018', 'submenus_name' => 'product_category.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1182', 'menus_code' => '1018', 'submenus_name' => 'product_category.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1183', 'menus_code' => '1018', 'submenus_name' => 'product_category.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1184', 'menus_code' => '1018', 'submenus_name' => 'product_category.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1185', 'menus_code' => '1018', 'submenus_name' => 'product_category.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1191', 'menus_code' => '1019', 'submenus_name' => 'brand.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1192', 'menus_code' => '1019', 'submenus_name' => 'brand.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1193', 'menus_code' => '1019', 'submenus_name' => 'brand.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1194', 'menus_code' => '1019', 'submenus_name' => 'brand.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1195', 'menus_code' => '1019', 'submenus_name' => 'brand.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1201', 'menus_code' => '1020', 'submenus_name' => 'uom.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1202', 'menus_code' => '1020', 'submenus_name' => 'uom.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1203', 'menus_code' => '1020', 'submenus_name' => 'uom.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1204', 'menus_code' => '1020', 'submenus_name' => 'uom.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1205', 'menus_code' => '1020', 'submenus_name' => 'uom.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1211', 'menus_code' => '1021', 'submenus_name' => 'warehouse.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1212', 'menus_code' => '1021', 'submenus_name' => 'warehouse.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1213', 'menus_code' => '1021', 'submenus_name' => 'warehouse.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1214', 'menus_code' => '1021', 'submenus_name' => 'warehouse.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1215', 'menus_code' => '1021', 'submenus_name' => 'warehouse.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1221', 'menus_code' => '1022', 'submenus_name' => 'customer.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1222', 'menus_code' => '1022', 'submenus_name' => 'customer.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1223', 'menus_code' => '1022', 'submenus_name' => 'customer.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1224', 'menus_code' => '1022', 'submenus_name' => 'customer.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1225', 'menus_code' => '1022', 'submenus_name' => 'customer.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1231', 'menus_code' => '1023', 'submenus_name' => 'customer_category.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1232', 'menus_code' => '1023', 'submenus_name' => 'customer_category.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1233', 'menus_code' => '1023', 'submenus_name' => 'customer_category.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1234', 'menus_code' => '1023', 'submenus_name' => 'customer_category.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1235', 'menus_code' => '1023', 'submenus_name' => 'customer_category.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1241', 'menus_code' => '1024', 'submenus_name' => 'company_type.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1242', 'menus_code' => '1024', 'submenus_name' => 'company_type.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1243', 'menus_code' => '1024', 'submenus_name' => 'company_type.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1244', 'menus_code' => '1024', 'submenus_name' => 'company_type.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1245', 'menus_code' => '1024', 'submenus_name' => 'company_type.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1251', 'menus_code' => '1025', 'submenus_name' => 'inquiry_goods.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1252', 'menus_code' => '1025', 'submenus_name' => 'inquiry_goods.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1253', 'menus_code' => '1025', 'submenus_name' => 'inquiry_goods.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1254', 'menus_code' => '1025', 'submenus_name' => 'inquiry_goods.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1255', 'menus_code' => '1025', 'submenus_name' => 'inquiry_goods.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1261', 'menus_code' => '1026', 'submenus_name' => 'origin_inquiries.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1262', 'menus_code' => '1026', 'submenus_name' => 'origin_inquiries.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1263', 'menus_code' => '1026', 'submenus_name' => 'origin_inquiries.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1264', 'menus_code' => '1026', 'submenus_name' => 'origin_inquiries.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1265', 'menus_code' => '1026', 'submenus_name' => 'origin_inquiries.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1271', 'menus_code' => '1027', 'submenus_name' => 'pillars.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1272', 'menus_code' => '1027', 'submenus_name' => 'pillars.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1273', 'menus_code' => '1027', 'submenus_name' => 'pillars.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1274', 'menus_code' => '1027', 'submenus_name' => 'pillars.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1275', 'menus_code' => '1027', 'submenus_name' => 'pillars.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1281', 'menus_code' => '1028', 'submenus_name' => 'checklists.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1282', 'menus_code' => '1028', 'submenus_name' => 'checklists.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1283', 'menus_code' => '1028', 'submenus_name' => 'checklists.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1284', 'menus_code' => '1028', 'submenus_name' => 'checklists.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1285', 'menus_code' => '1028', 'submenus_name' => 'checklists.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1291', 'menus_code' => '1029', 'submenus_name' => 'optionchecklists.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1292', 'menus_code' => '1029', 'submenus_name' => 'optionchecklists.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1293', 'menus_code' => '1029', 'submenus_name' => 'optionchecklists.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1294', 'menus_code' => '1029', 'submenus_name' => 'optionchecklists.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1295', 'menus_code' => '1029', 'submenus_name' => 'optionchecklists.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1301', 'menus_code' => '1030', 'submenus_name' => 'template_win_loses.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1302', 'menus_code' => '1030', 'submenus_name' => 'template_win_loses.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1303', 'menus_code' => '1030', 'submenus_name' => 'template_win_loses.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1304', 'menus_code' => '1030', 'submenus_name' => 'template_win_loses.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1305', 'menus_code' => '1030', 'submenus_name' => 'template_win_loses.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1311', 'menus_code' => '1031', 'submenus_name' => 'inquiry_statuses.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1312', 'menus_code' => '1031', 'submenus_name' => 'inquiry_statuses.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1313', 'menus_code' => '1031', 'submenus_name' => 'inquiry_statuses.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1314', 'menus_code' => '1031', 'submenus_name' => 'inquiry_statuses.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1315', 'menus_code' => '1031', 'submenus_name' => 'inquiry_statuses.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1321', 'menus_code' => '1032', 'submenus_name' => 'parameter_duedate.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1322', 'menus_code' => '1032', 'submenus_name' => 'parameter_duedate.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1323', 'menus_code' => '1032', 'submenus_name' => 'parameter_duedate.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1324', 'menus_code' => '1032', 'submenus_name' => 'parameter_duedate.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1325', 'menus_code' => '1032', 'submenus_name' => 'parameter_duedate.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1331', 'menus_code' => '1033', 'submenus_name' => 'decission_quotation.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1332', 'menus_code' => '1033', 'submenus_name' => 'decission_quotation.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1333', 'menus_code' => '1033', 'submenus_name' => 'decission_quotation.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1334', 'menus_code' => '1033', 'submenus_name' => 'decission_quotation.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1335', 'menus_code' => '1033', 'submenus_name' => 'decission_quotation.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1341', 'menus_code' => '1034', 'submenus_name' => 'quotation_statuses.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1342', 'menus_code' => '1034', 'submenus_name' => 'quotation_statuses.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1343', 'menus_code' => '1034', 'submenus_name' => 'quotation_statuses.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1344', 'menus_code' => '1034', 'submenus_name' => 'quotation_statuses.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1345', 'menus_code' => '1034', 'submenus_name' => 'quotation_statuses.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1351', 'menus_code' => '1035', 'submenus_name' => 'description_quotations.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1352', 'menus_code' => '1035', 'submenus_name' => 'description_quotations.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1353', 'menus_code' => '1035', 'submenus_name' => 'description_quotations.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1354', 'menus_code' => '1035', 'submenus_name' => 'description_quotations.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1355', 'menus_code' => '1035', 'submenus_name' => 'description_quotations.update', 'submenus_notes' => '-'],

            ['submenus_code' => '1361', 'menus_code' => '1036', 'submenus_name' => 'inquiry.create', 'submenus_notes' => '-'],
            ['submenus_code' => '1362', 'menus_code' => '1036', 'submenus_name' => 'inquiry.view', 'submenus_notes' => '-'],
            ['submenus_code' => '1363', 'menus_code' => '1036', 'submenus_name' => 'inquiry.edit', 'submenus_notes' => '-'],
            ['submenus_code' => '1364', 'menus_code' => '1036', 'submenus_name' => 'inquiry.delete', 'submenus_notes' => '-'],
            ['submenus_code' => '1365', 'menus_code' => '1036', 'submenus_name' => 'inquiry.update', 'submenus_notes' => '-'],
        ];

        Submenus::insert($submenu);
    }
}
