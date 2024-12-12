<?php

namespace App\Models;

use App\Observers\AdminObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo'
    ];


    protected $hidden = [
        'password'
    ];


    /**
     * Get the cached user model by ID.
     *
     * @param int $id
     * @return Admin|null
     */
    public static function getCachedAdmin($id)
    {
        $cacheKey = 'admin:' . $id;

        return Cache::remember($cacheKey, now()->addHour(), function () use ($id, $cacheKey) {
            $admin = static::find($id);
            if ($admin) {
                $admin->observe(new AdminObserver($cacheKey));
            }
            return $admin;
        });
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(AdminObserver::class);
    }

}
