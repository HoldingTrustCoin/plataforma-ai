<?php

use App\Models\BotHistory;
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
        Schema::table('bot_histories', function (Blueprint $table) {
            $table->string('capital')->after('bot_activation_id')->nullable();
            $table->string('profit_percent')->after('profit')->nullable();
        });

        // get the actual capital for existing trades
        $trades = BotHistory::get();
        foreach($trades as $trade) {
            $update = BotHistory::find($trade->id);
            $update->capital = $trade->botActivation->capital;
            $update->profit_percent = ($trade->profit / $trade->botActivation->capital * 100);
            $update->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bot_histories', function (Blueprint $table) {
            $table->dropColumn(['capital', 'profit_percent']);
        });
    }
};
