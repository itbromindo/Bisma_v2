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
        Schema::create('master_approvals_details', function (Blueprint $table) {
            $table->bigIncrements('master_approvals_details_id');
            $table->string('master_approvals_code', 225);
            $table->string('master_approvals_details_section', 225);
            $table->string('master_approvals_details_approvers', 255);

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_approvals_details');
    }
};
