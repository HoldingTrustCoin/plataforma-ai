<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoWallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'deposit_coin_id',
        'wallet_address',
        'whitelisted',
        'c_id'
    ];

    //user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // deposit coin relationship
    public function depositCoin()
    {
        return $this->belongsTo(DepositCoin::class);
    }
}
