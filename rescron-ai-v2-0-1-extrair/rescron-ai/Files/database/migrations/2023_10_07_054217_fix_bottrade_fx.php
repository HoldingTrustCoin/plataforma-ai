<?php

use App\Models\BotActivation;
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
        // select next trade
        $bot_activations = BotActivation::where('status', 'active')->get();
        foreach ($bot_activations as $act) {
            $timestamps = json_decode($act->gen_timestamps);


            if (count($timestamps) > 0) {
                $bal = BotActivation::find($act->id);
                $bal->next_trade = $timestamps[0] ?? null;
                $bal->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
