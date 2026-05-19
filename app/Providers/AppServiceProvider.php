<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Observers\AppointmentObserver;
use App\Models\Appointment;
use App\Observers\DonationObserver;
use App\Models\Donation;

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
        Donation::observe(DonationObserver::class);
        Appointment::observe(AppointmentObserver::class);

        // Force HTTPS in production environments to fix mixed content layout issues
        if (config('app.env') === 'production' || env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}