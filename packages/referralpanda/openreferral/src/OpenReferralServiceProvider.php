<?php

namespace ReferralPanda\OpenReferral;

use Illuminate\Support\ServiceProvider;

class OpenReferralServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make('ReferralPanda\OpenReferral\Http\controllers\OpenReferralController');
        $this->mergeConfigFrom(
            __DIR__.'/Config/open_referral.php', 'open_referral'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/Routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
//        $this->loadViewsFrom(__DIR__.'/views', 'openreferral');
        $this->publishes([
//            __DIR__.'/views' => base_path('resources/views/referralpanda/openreferral'),
            __DIR__.'/config/open_referral.php' => config_path('open_referral.php')
        ]);
    }
}
