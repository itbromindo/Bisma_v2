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
    }
}
