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
        Schema::create('customer_category', function (Blueprint $table) {
            $table->bigIncrements('customer_category_id');
            $table->string('customer_category_code', 225)->unique();
            $table->string('customer_category_name', 225)->nullable();
            $table->timestamp('customer_category_created_at')->nullable();
            $table->string('customer_category_created_by', 225)->nullable();
            $table->timestamp('customer_category_updated_at')->nullable();
            $table->string('customer_category_updated_by', 225)->nullable();
            $table->timestamp('customer_category_deleted_at')->nullable();
            $table->string('customer_category_deleted_by', 225)->nullable();
            $table->text('customer_category_notes')->nullable();
            $table->boolean('customer_category_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_category');
    }
};
