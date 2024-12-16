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
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('goods_id');
            $table->string('goods_code', 225)->unique();
            $table->string('goods_name', 225)->nullable(); // Nama Barang
            $table->string('goods_photo', 225)->nullable(); // Foto Barang
            $table->string('goods_usage', 225)->nullable(); // Peruntukan Barang (Hardcode: inventoris kantor, gudang)
            $table->string('goods_specification', 225)->nullable(); // Spesifikasi Barang (Hardcode: Umum, spesial)
            $table->string('brand_code', 225)->nullable(); // Brand (Master Data)
            $table->float('goods_price')->nullable(); // Harga Pokok
            $table->bigInteger('goods_stock')->nullable(); // Stok Barang
            $table->float('goods_end_user_margin')->nullable(); // Margin End User (%)
            $table->float('goods_contractor_margin')->nullable(); // Margin Kontraktor (%) 
            $table->float('goods_reseller_margin')->nullable(); // Margin Reseller (%)
            $table->float('goods_pricelist_margon')->nullable(); // Margin Price List (%)
            $table->float('goods_end_user_price')->nullable(); // Harga End User 
            $table->float('goods_contractor_price')->nullable(); // Harga Kontraktor
            $table->float('goods_reseller_price')->nullable(); // Harga Reseller
            $table->float('goods_pricelist_price')->nullable(); // Harga Price List
            $table->string('uom_code', 225)->nullable(); // Satuan (Master data)
            $table->float('goods_weight')->nullable(); // Berat (Kg)
            $table->string('product_division_code',225)->nullable(); // Type Barang / divisi barang (Master data)
            $table->string('product_category_code',225)->nullable(); // relasi Master data 
            $table->string('goods_availability',225)->nullable(); // Jenis Ketersediaan Produk (hardcode: ready, indent)
            $table->timestamp('goods_created_at')->nullable();
            $table->string('goods_created_by', 225)->nullable();
            $table->timestamp('goods_updated_at')->nullable();
            $table->string('goods_updated_by', 225)->nullable();
            $table->timestamp('goods_deleted_at')->nullable();
            $table->string('goods_deleted_by', 225)->nullable();
            $table->text('goods_notes')->nullable();
            $table->boolean('goods_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
