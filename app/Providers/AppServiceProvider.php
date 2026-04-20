<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SalesPage;
use App\Policies\SalesPagePolicy;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
        {
        // Register policy manually
        Gate::policy(SalesPage::class, SalesPagePolicy::class);
    }
}
