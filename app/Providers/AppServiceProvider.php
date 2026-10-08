<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use App\Observers\NotificationObserver;

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
        Notification::observe(NotificationObserver::class);

        // Share current company profile with views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $company = null;
            if ($company === null) {
                try {
                    $company = \App\Models\Company::first();
                } catch (\Exception $e) {
                    $company = null;
                }
            }
            $view->with('currentCompany', $company);
        });
    }
}
