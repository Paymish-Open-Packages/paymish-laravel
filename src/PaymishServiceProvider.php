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
        $this->publishes([
            __DIR__.'/../config/paymish.php' => config_path('paymish.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                PaymishPublishCommand::class,
            ]);
        }
    }
}
