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
        Schema::create('p2ps', function (Blueprint $table) {
            $table->id();
            $table->string('sender_id');
            $table->string('sender_name');
            $table->string('receiver_id');
            $table->string('receiver_name');
            $table->string('ref');
            $table->string('amount');
            $table->string('fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p2ps');
    }
};
