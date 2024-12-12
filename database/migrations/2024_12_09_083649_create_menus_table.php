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
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('menus_id');
            $table->string('menus_code', 225)->unique();
            $table->string('moduls_code', 225);
            $table->string('menus_name', 225);
            $table->string('menus_route', 225);
            $table->timestamp('menus_created_at')->nullable();
            $table->string('menus_created_by', 225)->nullable();
            $table->timestamp('menus_updated_at')->nullable();
            $table->string('menus_updated_by', 225)->nullable();
            $table->timestamp('menus_deleted_at')->nullable();
            $table->string('menus_deleted_by', 225)->nullable();
            $table->text('menus_notes')->nullable();
            $table->boolean('menus_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
