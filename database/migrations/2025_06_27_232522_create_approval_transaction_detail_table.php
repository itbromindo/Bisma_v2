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
        Schema::create('approval_transaction_detail', function (Blueprint $table) {
            $table->bigIncrements('approval_transaction_detail_id')->comment('ID detail approval');
            $table->string('approval_transaction_header_code', 225)->comment('Relasi dengan header approval_transaction_header');
            $table->integer('master_approvals_details_id')->comment('Relasi dengan master_approvals_details');
            $table->string('approval_transaction_detail_approvers', 225)->comment('User/approver yang menyetujui');
            $table->string('approval_transaction_detail_decision', 225)->comment('Keputusan: Approve / Not Approve / Waiting Approval');
            $table->timestamp('approval_transaction_detail_approval_date')->nullable()->comment('Waktu approval');
            $table->dateTime('approval_transaction_detail_start_date')->nullable()->comment('Due date awal approval (sementara null)');
            $table->dateTime('approval_transaction_detail_end_date')->nullable()->comment('Due date akhir approval (sementara null)');
            $table->string('approval_transaction_detail_reason', 225)->nullable()->comment('Alasan jika keputusan Not Approve');
            $table->timestamp('approval_transaction_detail_created_at')->nullable()->comment('Tanggal dibuat');
            $table->string('approval_transaction_detail_created_by')->nullable()->comment('Pembuat data');
            $table->timestamp('approval_transaction_detail_updated_at')->nullable()->comment('Tanggal update');
            $table->string('approval_transaction_detail_updated_by')->nullable()->comment('Pengupdate data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_transaction_detail');
    }
};
