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
        Schema::create('uom', function (Blueprint $table) {
            $table->bigIncrements('uom_id');
            $table->string('uom_code', 225)->unique();
            $table->string('uom_name', 225)->nullable();
            $table->timestamp('uom_created_at')->nullable();
            $table->string('uom_created_by', 225)->nullable();
            $table->timestamp('uom_updated_at')->nullable();
            $table->string('uom_updated_by', 225)->nullable();
            $table->timestamp('uom_deleted_at')->nullable();
            $table->string('uom_deleted_by', 225)->nullable();
            $table->text('uom_notes')->nullable();
            $table->boolean('uom_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uom');
    }
};
