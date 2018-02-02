<?php

namespace App\Providers;

use App\Observers\RepliesObservers;
use App\Reply;
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
