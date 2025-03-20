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
        Schema::create('inquiry_product', function (Blueprint $table) {
            $table->bigIncrements('inquiry_product_id');
            $table->string('inquiry_product_code');
            $table->string('inquiry_code', 225);
            $table->string('goods_code');
            $table->string('inquiry_product_name', 225);
            $table->string('inquiry_product_status_quote_no_quote');
            $table->integer('inquiry_product_qty');
            $table->string('inquiry_product_status_on_inquiry', 225);
            $table->string('inquiry_product_uom', 225);
            $table->double('inquiry_product_cost_of_goods', 15, 2);
            $table->double('inquiry_product_pricelist', 15, 2);
            $table->double('inquiry_product_net_price', 15, 2);
            $table->double('inquiry_taxes_percent', 8, 2);
            $table->double('inquiry_taxes_nominal', 15, 2);
            $table->double('inquiry_product_total_price', 15, 2);
            $table->text('inquiry_product_reason_no_quote')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry_product');
    }
};
