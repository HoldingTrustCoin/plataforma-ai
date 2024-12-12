<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositCoin extends Model
{
    use HasFactory;

    // define relation with deposit
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    // define relation with withdrawals
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    // define relationship with autowallets
    public function autoWallets()
    {
        return $this->hasMany(AutoWallet::class);
    }


    protected $fillable = [
        'code',
        'name',
        'wallet_regex',
        'priority',
        'logo_url',
        'network',
        'smart_contract',
        'network_precision',
        'precision',
        'ticker',
        'status',
        'can_withdraw'
    ];
    
}
