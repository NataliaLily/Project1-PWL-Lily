<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->bigInteger('user_id')->index();
        });
        Schema::table('kategoris', function (Blueprint $table) {
            $table->bigInteger('user_id')->index();
        });
        Schema::table('transaksis', function (Blueprint $table) {
            $table->bigInteger('user_id')->index();
        });
        Schema::table('jurnals', function (Blueprint $table) {
            $table->bigInteger('user_id')->index();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};

