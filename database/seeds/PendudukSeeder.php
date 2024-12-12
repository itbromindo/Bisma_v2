<?php

// namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
    public function run()
    {
        Penduduk::factory()->count(200)->create();
    }
}