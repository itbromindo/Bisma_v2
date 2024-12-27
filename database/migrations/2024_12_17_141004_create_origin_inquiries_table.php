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
        Schema::create('origin_inquiries', function (Blueprint $table) {
            $table->bigIncrements('origin_inquiry_id'); // Primary Key
            $table->string('origin_inquiry_code', 225)->unique();
            $table->string('origin_inquiry_name', 225); 
            $table->timestamp('origin_inquiry_created_at')->nullable(); 
            $table->string('origin_inquiry_created_by', 225)->nullable(); 
            $table->timestamp('origin_inquiry_updated_at')->nullable(); 
            $table->string('origin_inquiry_updated_by', 225)->nullable(); 
            $table->timestamp('origin_inquiry_deleted_at')->nullable(); 
            $table->string('origin_inquiry_deleted_by', 225)->nullable(); 
            $table->text('origin_inquiry_notes')->nullable(); 
            $table->boolean('origin_inquiry_soft_delete')->default(0); // Soft delete flag (0 = no, 1 = yes)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('origin_inquiries');
    }
};
