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
        Schema::create('product_divisions', function (Blueprint $table) {
            $table->bigIncrements('product_divisions_id');
            $table->string('product_divisions_code', 225)->unique();
            $table->string('product_divisions_name', 225)->nullable();
            $table->timestamp('product_divisions_created_at')->nullable();
            $table->string('product_divisions_created_by', 225)->nullable();
            $table->timestamp('product_divisions_updated_at')->nullable();
            $table->string('product_divisions_updated_by', 225)->nullable();
            $table->timestamp('product_divisions_deleted_at')->nullable();
            $table->string('product_divisions_deleted_by', 225)->nullable();
            $table->text('product_divisions_notes')->nullable();
            $table->boolean('product_divisions_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_divisions');
    }
};
