<?php

// namespace Database\Seeders;
// use App\Models\Penduduk;
// use Database\Seeders\PendudukSeeder;

use App\Models\Moduls;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(ModulSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SubmenuSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(HomebaseSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(MasterApprovalSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(InquiryGoodsStatusesSeeder::class);
        $this->call(OriginInquiriesSeeder::class);
        $this->call(DescriptionQuotationsSeeder::class);
        $this->call(ParameterDuedatesSeeder::class);
        $this->call(DecissionQuotationsSeeder::class);
        $this->call(PillarsSeeder::class);
        $this->call(ChecklistsSeeder::class);
        $this->call(OptionChecklistsSeeder::class);
        $this->call(TemplateWinLosesSeeder::class);
        $this->call(InquiryStatusesSeeder::class);
        $this->call(QuotationStatusesSeeder::class);
    }
}
