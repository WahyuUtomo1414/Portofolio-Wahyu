<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        // Register folder views/layouts agar bisa dipanggil via <x-layouts.public>
        Blade::anonymousComponentPath(resource_path('views/layouts'), 'layouts');
        Blade::component('layouts.public', 'layouts.public');
    }
}
