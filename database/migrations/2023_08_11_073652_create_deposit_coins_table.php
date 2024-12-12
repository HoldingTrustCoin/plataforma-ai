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
        Schema::create('deposit_coins', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('wallet_regex');
            $table->string('priority');
            $table->string('logo_url');
            $table->string('network')->nullable();
            $table->string('smart_contract')->nullable();
            $table->string('network_precision')->nullable();
            $table->string('precision');
            $table->string('ticker')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::table('deposits', function (Blueprint $table) {
            $table->unsignedBigInteger('deposit_coin_id')->after('user_id');
            $table->foreign('deposit_coin_id')->references('id')->on('deposit_coins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_coins');

        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn('deposit_coin_id');
        });
    }
};
