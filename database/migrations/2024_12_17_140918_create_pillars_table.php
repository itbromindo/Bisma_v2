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
        Schema::create('pillars', function (Blueprint $table) {
            $table->id('pillar_id');  // Customizing the primary key name
            $table->string('pillar_code', 225)->unique();
            $table->string('pillar_items', 225);
            $table->timestamp('pillar_created_at')->nullable();
            $table->string('pillar_created_by', 225)->nullable();
            $table->timestamp('pillar_updated_at')->nullable()->nullable();
            $table->string('pillar_updated_by', 225)->nullable();
            $table->timestamp('pillar_deleted_at')->nullable();
            $table->string('pillar_deleted_by', 225)->nullable();
            $table->text('pillar_notes')->nullable();
            $table->integer('pillar_soft_delete')->default(0);    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pillars');
    }
};
