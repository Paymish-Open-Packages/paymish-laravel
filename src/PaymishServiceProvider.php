<?php

namespace Paymish;

use Illuminate\Support\ServiceProvider;

class PaymishServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('paymish', function () {
            return new Paymish();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/paymish.php', 'paymish');
    }

    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../config/paymish.php' => config_path('paymish.php'),
        ], 'config');
    }
}
