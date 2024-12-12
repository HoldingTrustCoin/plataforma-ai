<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotHistory extends Model
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

    //bot activation relationship
    public function botActivation()
    {
        return $this->belongsTo(BotActivation::class);
    }

    protected $fillable = [
        'user_id',
        'bot_id',
        'bot_activation_id',
        'entry_price',
        'exit_price',
        'profit',
        'pair',
        'timestamp',
        'capital',
        'profit_percent'
    ];

    
    
}
