<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Data user default (jika belum ada)
        $user = \App\User::where('users_email', 'adicahyo@mail.com')->first();
        if (is_null($user)) {
            $user = new \App\User();
            $user->user_code = 'admin1'; // Random unique user code
            $user->users_name = "Adi Tri Cahyono";
            $user->users_email = "adicahyo@mail.com";
            $user->users_password = Hash::make('1234');
            $user->users_photo = null; // Default null
            $user->users_office_phone = '021-' . mt_rand(1000000, 9999999);
            $user->users_personal_phone = '081' . mt_rand(1000000000, 9999999999);
            $user->users_join_date = now();
            $user->users_level = 'admin';
            $user->users_company = 'Company ' . $faker->company;
            $user->users_homebase = 'Homebase ' . $faker->city;
            $user->users_division = 'Division ' . $faker->word;
            $user->users_department = 'Department ' . $faker->word;
            $user->users_shift = 'Shift ' . $faker->randomElement(['Morning', 'Afternoon', 'Night']);
            $user->users_employee_status = 'tetap'; // Default hardcoded
            $user->users_join_date_employee_status = now();
            $user->users_contract_period = null; // Null for permanent
            $user->users_notes = 'Default admin user';
            $user->users_gender = 'laki-laki'; // Default hardcoded
            $user->users_place_date_of_birth = $faker->city . ', ' . $faker->date();
            $user->users_education = $faker->randomElement(['SMA', 'D3', 'S1', 'S2']);
            $user->users_religion = $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']);
            $user->users_family_status = $faker->randomElement(['Belum Menikah', 'Menikah']);
            $user->users_address_of_domicile = $faker->address;
            $user->users_address_of_id = $faker->address;
            $user->users_family_card = 'KK-' . mt_rand(100000000, 999999999);
            $user->users_fb = 'fb.com/' . $faker->userName;
            $user->users_ig = 'instagram.com/' . $faker->userName;
            $user->users_bpjs_tk_number = 'TK-' . mt_rand(100000000, 999999999);
            $user->users_bpjs_number = 'BPJS-' . mt_rand(100000000, 999999999);
            $user->users_ktp_number = 'KTP-' . mt_rand(100000000, 999999999);
            $user->users_ktp_picture = null; // Default null
            $user->users_signature = null; // Default null
            $user->users_created_at = now();
            $user->users_created_by = 'system';
            $user->users_updated_at = null;
            $user->users_updated_by = null;
            $user->users_deleted_at = null;
            $user->users_deleted_by = null;
            $user->users_soft_delete = 0;
            $user->save();
        }
    }
}
