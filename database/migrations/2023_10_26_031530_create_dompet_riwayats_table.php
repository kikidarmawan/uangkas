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
        Schema::create('dompet_riwayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dompet_id')->constrained('dompets');
            $table->double('debit', 15, 2)->default(0);
            $table->double('kredit', 15, 2)->default(0);
            $table->double('saldo', 15, 2);
            $table->string('ref_id');
            $table->string('jns_trx');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dompet_riwayats');
    }
};
