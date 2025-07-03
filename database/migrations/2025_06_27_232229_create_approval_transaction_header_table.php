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
        Schema::create('approval_transaction_header', function (Blueprint $table) {
            $table->bigIncrements('approval_transaction_header_id')->comment('ID, standar field');
            $table->string('approval_transaction_header_code', 225)->nullable()->comment('Kode, standar field');
            $table->string('master_approvals_code', 225)->nullable()->comment('Jenis approval: Approval on call price / approval batal, Enhancement Master Approval_Product Requirement Document (PRD)');
            $table->string('transaction_number')->nullable()->comment('Nomor transaksi, misalnya nomor inquiry, nomor quotation, dll');
            $table->dateTime('approval_transaction_header_start_date')->nullable()->comment('Berkaitan dengan due date approval untuk tabel approval_transaction_header_stage_progress');
            $table->dateTime('approval_transaction_header_end_date')->nullable()->comment('Berkaitan dengan due date approval untuk tabel approval_transaction_header_stage_progress');
            $table->enum('approval_transaction_header_stage_progress', ['in progress', 'overdue', 'done'])
                  ->default('in progress')
                  ->comment('Progress dari stage approval: In progress, Overdue (NEXT PHASE), Done (pindah stage)');
            $table->timestamp('approval_transaction_header_created_at')->nullable()->comment('Tanggal dibuat');
            $table->string('approval_transaction_header_created_by')->nullable()->comment('Pembuat data');
            $table->timestamp('approval_transaction_header_updated_at')->nullable()->comment('Tanggal update');
            $table->string('approval_transaction_header_updated_by')->nullable()->comment('Pengupdate data');
            $table->timestamp('approval_transaction_header_deleted_at')->nullable()->comment('Tanggal hapus');
            $table->string('approval_transaction_header_deleted_by')->nullable()->comment('Penghapus data');
            $table->text('approval_transaction_header_notes')->nullable()->comment('Sementara tidak dipakai');
            $table->boolean('approval_transaction_header_soft_delete')->default(false)->comment('Soft delete flag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_transaction_header');
    }
};
