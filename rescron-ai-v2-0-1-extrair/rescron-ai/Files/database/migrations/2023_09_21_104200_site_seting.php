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
        $setting->key = 'preloader';
        $setting->value = 0;
        $setting->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $setting = Setting::where('key', 'preloader')->first();
        if ($setting) {
            $remove = Setting::find($setting->id);
            $remove->delete();
        }
    }
};
