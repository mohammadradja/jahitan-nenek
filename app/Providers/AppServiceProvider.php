<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.premium');

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                $siteName = \App\Models\SiteSetting::get('site_name');
                if ($siteName) {
                    config(['app.name' => $siteName]);
                }
            }
        } catch (\Exception $e) {
            // Safe guard against database migration issues
        }
    }
}
