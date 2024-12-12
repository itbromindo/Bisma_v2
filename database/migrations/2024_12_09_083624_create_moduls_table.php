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
        Schema::create('moduls', function (Blueprint $table) {
            $table->bigIncrements('moduls_id');
            $table->string('moduls_code', 225)->unique();
            $table->string('moduls_name', 225);
            $table->string('moduls_icon', 225)->nullable();
            $table->timestamp('moduls_created_at')->nullable();
            $table->string('moduls_created_by', 225)->nullable();
            $table->timestamp('moduls_updated_at')->nullable();
            $table->string('moduls_updated_by', 225)->nullable();
            $table->timestamp('moduls_deleted_at')->nullable();
            $table->string('moduls_deleted_by', 225)->nullable();
            $table->text('moduls_notes')->nullable();
            $table->boolean('moduls_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
