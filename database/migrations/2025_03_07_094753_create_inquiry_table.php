<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inquiry', function (Blueprint $table) {
            $table->id('inquiry_id');
            $table->string('inquiry_code', 225)->unique()->nullable();
            $table->string('inquiry_type', 225)->nullable();
            $table->timestamp('inquiry_created_at')->nullable();
            $table->string('inquiry_created_by', 225)->nullable();
            $table->timestamp('inquiry_updated_at')->nullable();
            $table->string('inquiry_updated_by', 225)->nullable();
            $table->timestamp('inquiry_deleted_at')->nullable();
            $table->string('inquiry_deleted_by', 225)->nullable();
            $table->text('inquiry_notes')->nullable();
            $table->integer('inquiry_soft_delete')->default(0);
            $table->timestamp('inquiry_start_date')->nullable();
            $table->timestamp('inquiry_end_date')->nullable();
            $table->string('inquiry_customer', 225)->nullable();
            $table->string('inquiry_origin', 225)->nullable();
            $table->string('inquiry_date_and_location', 225)->nullable();
            $table->string('inquiry_stage', 225)->nullable();
            $table->string('inquiry_stage_progress', 225)->nullable();
            $table->json('inquiry_product_division')->nullable();
            $table->string('inquiry_warehouse', 225)->nullable();
            $table->string('inquiry_customer_type', 225)->nullable();
            $table->string('inquiry_oc', 225)->nullable();
            $table->double('inquiry_shipping_cost', 10, 2)->default(0.00);
            $table->text('inquiry_wording_card_header')->nullable();
            $table->double('inquiry_tax', 10, 2)->default(0.00);
            $table->double('inquiry_total_no_tax', 10, 2)->default(0.00);
            $table->double('inquiry_grand_total', 10, 2)->default(0.00);
            $table->string('inquiry_product_grand_total_status', 225)->nullable();
            $table->string('inquiry_sales', 225)->nullable();
            $table->text('inquiry_footer_note_inquiry')->nullable();
            $table->string('inquiry_flag_quote', 225)->nullable();
            $table->json('inquiry_teams')->nullable();
            $table->integer('inquiry_total_files')->default(0);
            $table->integer('inquiry_total_chats')->default(0);
            
            $table->index('inquiry_code', 'inquiry_inquiry_code_IDX');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inquiry');
    }
};
