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
        $setting = Setting::where('key', 'auto_withdraw')->get();
        if ($setting->count() > 1) {
            $auto_withdraw = Setting::where('key', 'auto_withdraw')->orderBy('id', 'DESC')->first();
            $remove = Setting::find($auto_withdraw->id);
            $remove->delete();
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
