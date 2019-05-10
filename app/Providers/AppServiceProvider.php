<?php

namespace App\Providers;
use EasyWeChat\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        // mini program
        $this->app->singleton('mini', function ($app) {
            return Factory::miniProgram(config('app.mini_config',[]));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
