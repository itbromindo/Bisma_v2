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
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('taxes_id');
            $table->integer('taxes_code')->unique(); 
            $table->string('taxes_name', 225)->nullable();
            $table->timestamp('taxes_created_at')->nullable();
            $table->string('taxes_created_by', 225)->nullable();
            $table->timestamp('taxes_updated_at')->nullable();
            $table->string('taxes_updated_by', 225)->nullable();
            $table->timestamp('taxes_deleted_at')->nullable();
            $table->string('taxes_deleted_by', 225)->nullable();
            $table->text('taxes_notes')->nullable();
            $table->boolean('taxes_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
