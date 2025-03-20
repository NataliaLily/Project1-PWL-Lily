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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->string('reference_table');
            $table->string('reference_id');
            $table->bigInteger("wallet_id")->index('wallet_id');
            $table->decimal('nominal',20,2);
            $table->string('in_out',10);
            $table->string('deskripsi');
            $table->date('tanggal');
            $table->index(['reference_table','reference_id'],'reference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
