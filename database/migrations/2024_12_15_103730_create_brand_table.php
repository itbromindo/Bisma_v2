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
        Schema::create('brand', function (Blueprint $table) {
            $table->bigIncrements('brand_id');
            $table->string('brand_code', 225)->unique();
            $table->string('brand_name', 225)->nullable();
            $table->timestamp('brand_created_at')->nullable();
            $table->string('brand_created_by', 225)->nullable();
            $table->timestamp('brand_updated_at')->nullable();
            $table->string('brand_updated_by', 225)->nullable();
            $table->timestamp('brand_deleted_at')->nullable();
            $table->string('brand_deleted_by', 225)->nullable();
            $table->text('brand_notes')->nullable();
            $table->boolean('brand_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
