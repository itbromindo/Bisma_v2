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
        Schema::create('quotation_statuses', function (Blueprint $table) {
            $table->id('quotation_status_id');
            $table->string('quotation_status_code', 225)->unique('unique_quotation_status_code');
            $table->string('quotation_status_name', 225);
            $table->timestamp('quotation_status_created_at')->nullable()->useCurrent();
            $table->string('quotation_status_created_by', 225);
            $table->timestamp('quotation_status_updated_at')->nullable()->useCurrentOnUpdate();
            $table->string('quotation_status_updated_by', 225)->nullable();
            $table->timestamp('quotation_status_deleted_at')->nullable();
            $table->string('quotation_status_deleted_by', 225)->nullable();
            $table->text('quotation_status_notes')->nullable();
            $table->integer('quotation_status_soft_delete')->default(0); // 1: yes, 0: no
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_statuses');
    }
};
