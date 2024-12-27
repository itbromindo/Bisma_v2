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
        Schema::create('template_decission_quotation', function (Blueprint $table) {
            $table->id('template_decission_quotation_id');
            $table->string('template_decission_quotation_code', 225)->unique('unique_code');
            $table->string('template_decission_quotation_title', 225); // quote & no quote
            $table->text('template_decission_quotation_text');
            $table->timestamp('template_decission_quotation_created_at')->nullable()->useCurrent();
            $table->string('template_decission_quotation_created_by', 225);
            $table->timestamp('template_decission_quotation_updated_at')->nullable()->useCurrentOnUpdate();
            $table->string('template_decission_quotation_updated_by', 225)->nullable();
            $table->timestamp('template_decission_quotation_deleted_at')->nullable();
            $table->string('template_decission_quotation_deleted_by', 225)->nullable();
            $table->text('template_decission_quotation_notes')->nullable();
            $table->integer('template_decission_quotation_soft_delete')->default(0); // 1: yes, 0: no
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_decission_quotation');
    }
};
