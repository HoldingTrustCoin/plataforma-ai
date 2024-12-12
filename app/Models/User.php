<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use App\Observers\UserObserver;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'balance',
        'address',
        'city',
        'state',
        'country',
        'photo',
        'gender',
        'email_verified_at',
        'phone',
        'dob',
        'password',
        'kyc_verified_at',
        'referred_by',
        'status',
        'g2fa',
        'g2fa_secret'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'kyc_verified_at' => 'datetime',
    ];

    /**
     * Get the KYC records associated with the user.
     */
    public function kycRecords()
    {
        return $this->hasMany(KycRecord::class);
    }



    //get deposits
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    //get withdrawals
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    //get transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    //get bot activations
    public function botActivations()
    {
        return $this->hasMany(BotActivation::class);
    }

    //bot trading history
    public function botHistory()
    {
        return $this->hasMany(BotHistory::class);
    }


    // define relationship with autowallets
    public function autoWallets()
    {
        return $this->hasMany(AutoWallet::class);
    }

    /**
     * Get the cached user model by ID.
     *
     * @param int $id
     * @return User|null
     */
    public static function getCachedUser($id)
    {
        $cacheKey = 'user:' . $id;

        return Cache::remember($cacheKey, now()->addHour(), function () use ($id, $cacheKey) {
            $user = static::find($id);
            if ($user) {
                $user->observe(new UserObserver($cacheKey));
            }
            return $user;
        });
    }

    //referral relationship using the 'referred_by' column
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by', 'username');
    }

    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by', 'username');
    }


    public function getReferralTree($level = 1, $maxLevel = 10)
    {
        $tree = [];

        if ($level > $maxLevel) {
            return $tree;
        }

        $referrals = $this->referredUsers;

        foreach ($referrals as $referral) {
            $referralData = [
                'user' => $referral,
                'level' => $level,
                'children' => $referral->getReferralTree($level + 1, $maxLevel),
            ];

            $tree[] = $referralData;
        }

        return $tree;
    }


    // give referral bonus
    public function giveReferralBonus($depositAmount, $depth = 1)
    {
        if ($depth > 10 || !$this->referrer) {
            return;
        }

        // Calculate and award the bonus to the current upline member
        $percentage_bonus = json_decode(site('bonus'));
        $percentage_bonus = $percentage_bonus[$depth - 1];

        if ($percentage_bonus > 0) {
            $amount = $percentage_bonus / 100 * $depositAmount;
            $this->referrer->balance += $amount;
            $this->referrer->save();

            recordNewTransaction($amount, $this->referrer->id, 'credit', 'Referral Bonus');

            // Recursively call the function for the next upline member
            $this->referrer->giveReferralBonus($depositAmount, $depth + 1);
        }
    }



    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(UserObserver::class);
    }
}
