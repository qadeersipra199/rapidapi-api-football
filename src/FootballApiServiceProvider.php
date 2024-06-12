<?php

namespace Rapidapi\FootballApi;


use Illuminate\Support\ServiceProvider;


class FootballApiServiceProvider extends ServiceProvider
{


    public function boot()
    {
        $this->publishes([

            __DIR__ . '/config/footballapi.php' => config_path('footballapi.php')
        ]);
    }

    public function register()
    {

        $this->app->singleton(FootballApi::class, function () {
            return new FootballApi();
        });
    }
}
