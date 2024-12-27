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
        Schema::create('inquiry_goods_status', function (Blueprint $table) {
            $table->bigIncrements('inquiry_goods_status_id'); // Primary Key
            $table->string('inquiry_goods_status_code', 225)->unique();
            $table->string('inquiry_goods_status_name', 225);
            $table->timestamp('inquiry_goods_status_created_at')->nullable();
            $table->string('inquiry_goods_status_created_by', 225)->nullable();
            $table->timestamp('inquiry_goods_status_updated_at')->nullable();
            $table->string('inquiry_goods_status_updated_by', 225)->nullable();
            $table->timestamp('inquiry_goods_status_deleted_at')->nullable();
            $table->string('inquiry_goods_status_deleted_by', 225)->nullable();
            $table->text('inquiry_goods_status_notes')->nullable();
            $table->integer('inquiry_goods_status_soft_delete')->default(0); // 1 for soft deleted, 0 for not deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_goods_status');
    }
};
