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
        Schema::create('company_type', function (Blueprint $table) {
            $table->bigIncrements('company_type_id');
            $table->string('company_type_code', 225)->unique();
            $table->string('company_type_name', 225)->nullable();
            $table->timestamp('company_type_created_at')->nullable();
            $table->string('company_type_created_by', 225)->nullable();
            $table->timestamp('company_type_updated_at')->nullable();
            $table->string('company_type_updated_by', 225)->nullable();
            $table->timestamp('company_type_deleted_at')->nullable();
            $table->string('company_type_deleted_by', 225)->nullable();
            $table->text('company_type_notes')->nullable();
            $table->boolean('company_type_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_type');
    }
};
