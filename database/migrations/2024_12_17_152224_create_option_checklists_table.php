<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_checklist', function (Blueprint $table) {
            $table->id('option_checklist_id');
            $table->string('option_checklist_code', 225)->unique();
            $table->string('checklist_code', 225);
            $table->string('option_checklist_items', 225);
            $table->timestamp('option_checklist_created_at')->nullable();
            $table->string('option_checklist_created_by', 225)->nullable();
            $table->timestamp('option_checklist_updated_at')->nullable();
            $table->string('option_checklist_updated_by', 225)->nullable();
            $table->timestamp('option_checklist_deleted_at')->nullable();
            $table->string('option_checklist_deleted_by', 225)->nullable();
            $table->text('option_checklist_notes')->nullable();
            $table->integer('option_checklist_soft_delete')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_checklist');
    }
};
