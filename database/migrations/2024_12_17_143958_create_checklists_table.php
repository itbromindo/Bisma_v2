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
        Schema::create('checklists', function (Blueprint $table) {
            $table->id('checklist_id'); // Custom primary key
            $table->string('checklist_code', 225)->unique();
            $table->string('pillar_code', 225); 
            $table->string('checklist_items', 225);
            $table->timestamp('checklist_created_at')->nullable();
            $table->string('checklist_created_by', 225)->nullable();
            $table->timestamp('checklist_updated_at')->nullable()->nullable();
            $table->string('checklist_updated_by', 225)->nullable();
            $table->timestamp('checklist_deleted_at')->nullable();
            $table->string('checklist_deleted_by', 225)->nullable();
            $table->text('checklist_notes')->nullable();
            $table->integer('checklist_soft_delete')->default(0);
            
            // Foreign key constraint
            $table->foreign('pillar_code')->references('pillar_code')->on('pillars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
