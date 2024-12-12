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
        // update env
        $envs = [
            "TELEGRAM_CHAT_GROUP_ID" => "xxxxx"
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
        
    }
};
