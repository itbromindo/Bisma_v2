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
        Schema::create('warehouse', function (Blueprint $table) {
            $table->bigIncrements('warehouse_id');
            $table->string('warehouse_code', 225)->unique();
            $table->string('warehouse_name', 225)->nullable();
            $table->timestamp('warehouse_created_at')->nullable();
            $table->string('warehouse_created_by', 225)->nullable();
            $table->timestamp('warehouse_updated_at')->nullable();
            $table->string('warehouse_updated_by', 225)->nullable();
            $table->timestamp('warehouse_deleted_at')->nullable();
            $table->string('warehouse_deleted_by', 225)->nullable();
            $table->text('warehouse_notes')->nullable();
            $table->boolean('warehouse_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse');
    }
};
