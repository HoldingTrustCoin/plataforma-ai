<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    //get bot activations
    public function botActivations()
    {
        return $this->hasMany(BotActivation::class);
    }

    //get bot history
    public function botHistory()
    {
        return $this->hasMany(BotHistory::class);
    }

    protected $fillable = [

        'name',
        'daily_min',
        'daily_max',
        'min',
        'max',
        'status',
        'duration',
        'duration_type',
        'logo'
    ];
}
