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
        Schema::create('submenus', function (Blueprint $table) {
            $table->bigIncrements('submenus_id');
            $table->string('submenus_code', 225)->unique();
            $table->string('menus_code', 225);
            $table->string('submenus_name', 225);
            $table->timestamp('submenus_created_at')->nullable();
            $table->string('submenus_created_by', 225)->nullable();
            $table->timestamp('submenus_updated_at')->nullable();
            $table->string('submenus_updated_by', 225)->nullable();
            $table->timestamp('submenus_deleted_at')->nullable();
            $table->string('submenus_deleted_by', 225)->nullable();
            $table->text('submenus_notes')->nullable();
            $table->boolean('submenus_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submenus');
    }
};
