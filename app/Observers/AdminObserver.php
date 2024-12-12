<?php

namespace App\Observers;

use App\Models\Admin;
use Illuminate\Support\Facades\Cache;

class AdminObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(Admin $admin): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Admin $admin): void
    {
        // Clear the cached user model
        Cache::forget('admin:' . $admin->id);
        
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Admin $admin): void
    {
        // Clear the cached user model
        Cache::forget('admin:' . $admin->id);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Admin $admin): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Admin $admin): void
    {
        //
    }
}
