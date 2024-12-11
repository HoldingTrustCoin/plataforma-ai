<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;
    protected $fillable =  [
        'key',
        'value'
    ];


    //get the setting by key
    public static function getValue($key)
    {
        $setting = self::where('key', $key)->first();

        return $setting ? $setting->value : null;
    }


    //Update the setting by key
    public static function updateSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            $settingModel = self::firstOrNew(['key' => $key]);
            $settingModel->value = $value;
            $settingModel->save();
        }

        Cache::forget('site');

        
    }


}
