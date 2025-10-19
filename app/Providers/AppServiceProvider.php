<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Prism;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('openai', function () {
            return Prism::text()->using(Provider::OpenAI, 'gpt-4o-mini');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
