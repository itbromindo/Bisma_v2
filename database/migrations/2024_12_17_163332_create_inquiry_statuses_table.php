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
        Schema::create('inquiry_statuses', function (Blueprint $table) {
            $table->id('inquiry_status_id');
            $table->string('inquiry_status_code', 225)->unique();
            $table->string('inquiry_status_name', 225);
            $table->text('inquiry_status_notes')->nullable();
            $table->timestamp('inquiry_status_created_at')->nullable()->useCurrent();
            $table->string('inquiry_status_created_by', 225);
            $table->timestamp('inquiry_status_updated_at')->nullable()->useCurrentOnUpdate();
            $table->string('inquiry_status_updated_by', 225)->nullable();
            $table->timestamp('inquiry_status_deleted_at')->nullable();
            $table->string('inquiry_status_deleted_by', 225)->nullable();
            $table->integer('inquiry_status_soft_delete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_statuses');
    }
};
