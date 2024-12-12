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
        Schema::create('level', function (Blueprint $table) {
            $table->bigIncrements('level_id');
            $table->string('level_code', 225)->unique();
            $table->string('department_code', 225);
            $table->string('level_name', 225);
            $table->timestamp('level_created_at')->nullable();
            $table->string('level_created_by', 225)->nullable();
            $table->timestamp('level_updated_at')->nullable();
            $table->string('level_updated_by', 225)->nullable();
            $table->timestamp('level_deleted_at')->nullable();
            $table->string('level_deleted_by', 225)->nullable();
            $table->text('level_notes')->nullable();
            $table->boolean('level_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level');
    }
};
