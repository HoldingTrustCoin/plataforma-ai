<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotActivation extends Model
{
    use HasFactory;

    //user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //bot relationship
    public function bot()
    {
        return $this->belongsTo(Bot::class);
    }


    //get bot history
    public function botHistory()
    {
        return $this->hasMany(BotHistory::class);
    }

    protected $fillable = [

        'user_id',
        'bot_id',
        'capital',
        'balance',
        'profit',
        'expires_in',
        'gen_timestamps',
        'daily_sequence',
        'daily_timestamp',
        'status',
        'daily_profit',
        'next_trade'
    ];
}
