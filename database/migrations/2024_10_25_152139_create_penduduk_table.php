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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->increments('penId');
            $table->string('penNik', 16)->nullable();
            $table->string('penNama', 100)->nullable();
            $table->string('penTempatLahir', 100)->nullable();
            $table->date('penTglLahir')->nullable();
            $table->longText('penImage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
