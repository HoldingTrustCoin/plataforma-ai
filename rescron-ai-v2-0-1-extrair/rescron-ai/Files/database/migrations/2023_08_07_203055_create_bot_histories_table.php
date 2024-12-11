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
        Schema::create('bot_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('bot_id');
            $table->foreign('bot_id')->references('id')->on('bots')->onDelete('cascade');
            $table->unsignedBigInteger('bot_activation_id');
            $table->foreign('bot_activation_id')->references('id')->on('bot_activations')->onDelete('cascade');
            $table->string('pair');
            $table->string('entry_price');
            $table->string('exit_price');
            $table->string('profit');
            $table->string('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_histories');
    }
};
