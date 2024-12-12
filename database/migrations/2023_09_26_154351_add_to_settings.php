<?php

use App\Models\Setting;
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
        $setting = new Setting();
        $setting->key = 'auto_withdraw';
        $setting->value = 0;
        $setting->save();
        
        // update env
        $envs = [
            "NP_G2FA_SECRET" => "xx",
            "NP_EMAIL" => "xxx@xx.com",
            "NP_PASSWORD" => "xxxx"
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
        $setting = Setting::where('key', 'auto_withdraw')->first();
        if ($setting) {
            $remove = Setting::find($setting->id);
            $remove->delete();
        }
    }
};
