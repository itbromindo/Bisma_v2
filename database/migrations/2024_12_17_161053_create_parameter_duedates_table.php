<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parameter_duedates', function (Blueprint $table) {
            $table->bigIncrements('param_duedate_id');
            $table->string('param_duedate_code', 225)->unique();
            $table->string('param_duedate_name', 225);
            $table->string('param_duedate_time');
            $table->string('user_code', 225); // Relasi dengan tabel users
            $table->timestamp('param_duedate_created_at')->nullable();
            $table->string('param_duedate_created_by', 225)->nullable();
            $table->timestamp('param_duedate_updated_at')->nullable();
            $table->string('param_duedate_updated_by', 225)->nullable();
            $table->timestamp('param_duedate_deleted_at')->nullable();
            $table->string('param_duedate_deleted_by', 225)->nullable();
            $table->text('param_duedate_notes')->nullable();
            $table->boolean('param_duedate_soft_delete')->default(0); // Untuk soft deleted 1 yes, 0 no

            // Menambahkan foreign key
            $table->foreign('user_code')->references('user_code')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parameter_duedates', function (Blueprint $table) {
            $table->dropForeign(['user_code']); // Menghapus foreign key constraint
        });

        Schema::dropIfExists('parameter_duedates');
    }
};
