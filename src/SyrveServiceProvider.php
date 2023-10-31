<?php

namespace Neverlxsss\Syrve;

use Illuminate\Support\ServiceProvider;

class SyrveServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/syrve.php' => config_path('syrve.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->bind('syrve', function () {
            return new Syrve();
        });
    }

    public function provides(): array
    {
        return ['syrve'];
    }
}
