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
        Schema::create('product_category', function (Blueprint $table) {
            $table->bigIncrements('product_category_id');
            $table->string('product_category_code', 225)->unique();
            $table->string('product_category_name', 225)->nullable();
            $table->timestamp('product_category_created_at')->nullable();
            $table->string('product_category_created_by', 225)->nullable();
            $table->timestamp('product_category_updated_at')->nullable();
            $table->string('product_category_updated_by', 225)->nullable();
            $table->timestamp('product_category_deleted_at')->nullable();
            $table->string('product_category_deleted_by', 225)->nullable();
            $table->text('product_category_notes')->nullable();
            $table->boolean('product_category_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
};
