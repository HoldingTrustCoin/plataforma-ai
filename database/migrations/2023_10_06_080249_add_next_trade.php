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
        Schema::table('bot_activations', function (Blueprint $table) {
            $table->string('next_trade')->nullable();
        });

        // select next trade
        $bot_activations = BotActivation::where('status', 'active')->get();
        foreach ($bot_activations as $act) {
            $timestamps = json_decode($act->gen_timestamps);


            if (count($timestamps) > 0) {
                $bal = BotActivation::find($act->id);
                $bal->next_trade = $timestamps[0];
                $bal->save();
            }
        }

        // update env
         $envs = [
            "TELEGRAM_BOT_TOKEN" => "xxx",
            "TELEGRAM_CHAT_ID" => "xxxxx.com"
        ];
        $env_file_path = base_path('.env');
        $original_env = file_get_contents($env_file_path);
        $new_env = $original_env;
        foreach($envs as $key => $value) {
            if (!env($key)) {
                $new_env .=  "\n" . $key . '="'.$value.'"';
            }
        }
       
        file_put_contents($env_file_path, $new_env);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bot_activations', function (Blueprint $table) {
            $table->dropColumn('next_trade');
        });
    }
};
