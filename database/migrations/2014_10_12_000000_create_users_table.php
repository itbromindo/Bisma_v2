<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_code', 225)->unique();
            $table->string('users_name', 225);
            $table->string('users_photo', 225)->nullable();
            $table->string('users_email', 225)->unique();
            $table->string('users_password', 225);
            $table->string('users_office_phone', 225)->nullable();
            $table->string('users_personal_phone', 225)->nullable();
            $table->date('users_join_date')->nullable();
            $table->string('users_level', 225)->nullable();
            $table->string('users_company', 225)->nullable();
            $table->string('users_homebase', 225)->nullable();
            $table->string('users_division', 225)->nullable();
            $table->string('users_department', 225)->nullable();
            $table->string('users_shift', 225)->nullable();
            $table->string('users_employee_status', 225)->nullable();
            $table->date('users_join_date_employee_status')->nullable();
            $table->string('users_contract_period', 225)->nullable();
            $table->text('users_notes')->nullable();
            $table->string('users_gender', 225)->nullable();
            $table->string('users_place_date_of_birth', 225)->nullable();
            $table->string('users_education', 225)->nullable();
            $table->string('users_religion', 225)->nullable();
            $table->string('users_family_status', 225)->nullable();
            $table->string('users_address_of_domicile', 225)->nullable();
            $table->string('users_address_of_id', 225)->nullable();
            $table->string('users_family_card', 225)->nullable();
            $table->string('users_fb', 225)->nullable();
            $table->string('users_ig', 225)->nullable();
            $table->string('users_bpjs_tk_number', 225)->nullable();
            $table->string('users_bpjs_number', 225)->nullable();
            $table->string('users_ktp_number', 225)->nullable();
            $table->string('users_ktp_picture', 225)->nullable();
            $table->string('users_signature', 225)->nullable();
            $table->timestamp('users_created_at')->nullable();
            $table->string('users_created_by', 225)->nullable();
            $table->timestamp('users_updated_at')->nullable();
            $table->string('users_updated_by', 225)->nullable();
            $table->timestamp('users_deleted_at')->nullable();
            $table->string('users_deleted_by', 225)->nullable();
            $table->boolean('users_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
