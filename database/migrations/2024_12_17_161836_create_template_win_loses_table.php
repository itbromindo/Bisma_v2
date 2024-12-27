<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateWinLosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_win_loses', function (Blueprint $table) {
            $table->bigIncrements('template_win_loses_id');
            $table->string('template_win_loses_code', 225)->unique();
            $table->string('template_win_loses_title', 225);
            $table->text('template_win_loses_text');
            $table->timestamp('template_win_loses_created_at')->useCurrent()->nullable();
            $table->string('template_win_loses_created_by', 225)->nullable();
            $table->timestamp('template_win_loses_updated_at')->useCurrent()->nullable();
            $table->string('template_win_loses_updated_by', 225)->nullable();
            $table->timestamp('template_win_loses_deleted_at')->nullable();
            $table->string('template_win_loses_deleted_by', 225)->nullable();
            $table->text('template_win_loses_notes')->nullable();
            $table->integer('template_win_loses_soft_delete')->default(0); // 0 for no, 1 for yes

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_win_loses');
    }
}
