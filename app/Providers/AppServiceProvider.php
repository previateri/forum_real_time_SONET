<?php

namespace App\Providers;

use App\Observers\PhotoUserObserver;
use App\Observers\RepliesObservers;
use App\Reply;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Reply::observe(RepliesObservers::class);
        User::observe(PhotoUserObserver::class);

        \Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
