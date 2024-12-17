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
        Schema::create('description_quotations', function (Blueprint $table) {
            $table->bigIncrements('template_inquiry_desc_id'); // Primary Key
            $table->string('template_inquiry_desc_code', 225)->unique();
            $table->string('template_inquiry_desc_title', 225); // Deskripsi Quotation
            $table->text('template_inquiry_desc_text'); 
            $table->timestamp('template_inquiry_desc_created_at')->nullable();
            $table->string('template_inquiry_desc_created_by', 225)->nullable(); 
            $table->timestamp('template_inquiry_desc_updated_at')->nullable();
            $table->string('template_inquiry_desc_updated_by', 225)->nullable(); 
            $table->timestamp('template_inquiry_desc_deleted_at')->nullable();
            $table->string('template_inquiry_desc_deleted_by', 225)->nullable(); 
            $table->text('template_inquiry_desc_notes')->nullable(); 
            $table->boolean('template_inquiry_desc_soft_delete')->default(0); // Soft delete flag (0 = no, 1 = yes)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_quotations');
    }
};
