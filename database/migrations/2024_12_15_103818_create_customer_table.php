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
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('customer_code', 225)->unique();
            $table->string('customer_name', 225)->nullable();
            $table->integer('customers_existing'); // Customer Existing
            $table->text('customers_full_address')->nullable(); // Alamat
            $table->string('customers_phone', 225)->nullable(); // No Telp
            $table->string('customers_email', 225)->nullable(); // Email
            $table->string('customers_PIC', 225)->nullable(); // PIC
            $table->string('customers_npwp', 225)->nullable(); // NPWP
            $table->string('customers_village', 225)->nullable(); // Desa / Kelurahan
            $table->string('districts_code', 225)->nullable(); // Kecamatan (Master data: )
            $table->string('cities_code', 225)->nullable(); // Kota / Kabupaten (Master data: )
            $table->string('provinces_code', 225)->nullable(); // Provinsi (Master data: )
            $table->string('customers_category', 225)->nullable(); // Kategori (Hardcode: End user, kontraktor, reseller)
            $table->string('customers_area', 225)->nullable(); // Wilayah (Hardcode: barat, tengah, timur )
            $table->timestamp('customers_created_at')->nullable();
            $table->string('customers_created_by', 225)->nullable();
            $table->timestamp('customers_updated_at')->nullable();
            $table->string('customers_updated_by', 225)->nullable();
            $table->timestamp('customers_deleted_at')->nullable();
            $table->string('customers_deleted_by', 225)->nullable();
            $table->text('customers_notes')->nullable();
            $table->boolean('customers_soft_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
