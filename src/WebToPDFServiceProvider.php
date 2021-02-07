<?php

namespace DevRaeph\WebToPdf;

use Illuminate\Support\ServiceProvider;

class WebToPDFServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * Test
     * @return void
     */
    public function register()
    {
        //
       // $this->app->make('DevStorm\UrlToPDF\UrlToPDF');
        $this->app->bind('webtopdf', function($app) {
            return new WebToPDF();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ds_webtopdf');
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('ds_webtopdf.php'),
            ], 'config');

        }
    }
}
