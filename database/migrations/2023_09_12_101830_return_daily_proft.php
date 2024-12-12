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
        Schema::table('bot_activations', function (Blueprint $table) {
            $table->string('daily_profit')->default(0)->after('daily_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bot_activations', function (Blueprint $table) {
            $table->dropColumn(['daily_profit']);
        });
    }
};
