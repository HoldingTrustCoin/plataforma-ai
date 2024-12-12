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
        Schema::create('bot_activations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('bot_id');
            $table->foreign('bot_id')->references('id')->on('bots')->onDelete('cascade');
            $table->string('capital');
            $table->string('balance');
            $table->string('profit');
            $table->string('expires_in');
            $table->longText('gen_timestamps');
            $table->longText('daily_sequence');
            $table->string('daily_timestamp');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_activations');
    }
};
