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
        Schema::create('master_approvals', function (Blueprint $table) {
            $table->bigIncrements('master_approvals_id');
            $table->string('master_approvals_code', 225)->unique();
            $table->string('master_approvals_approval_name', 225);
            $table->string('department_code', 225);
            $table->string('division_code', 225);
            $table->string('level_code', 225);
            $table->timestamp('master_approvals_created_at')->nullable();
            $table->string('master_approvals_created_by', 225)->nullable();
            $table->timestamp('master_approvals_updated_at')->nullable();
            $table->string('master_approvals_updated_by', 225)->nullable();
            $table->timestamp('master_approvals_deleted_at')->nullable();
            $table->string('master_approvals_deleted_by', 225)->nullable();
            $table->text('master_approvals_notes')->nullable();
            $table->integer('master_approvals_soft_delete')->default(0);

            // Foreign key constraints
            $table->foreign('department_code')->references('department_code')->on('departments')->onDelete('cascade');
            $table->foreign('division_code')->references('division_code')->on('divisions')->onDelete('cascade');
            $table->foreign('level_code')->references('level_code')->on('level')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_approvals');
    }
};
