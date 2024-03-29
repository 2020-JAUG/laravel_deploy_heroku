<?php

namespace App\Providers;

use Generator;
use Illuminate\Support\ServiceProvider;

//INSTANCIAMOS LAS DEPENDENCIAS
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REDIRECT_HTTPS')) {
        $this->app['request']->server->set('HTTPS', true);
    }
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        Schema::defaultStringLength(191);
        if (env('REDIRECT_HTTP')) {
            $url->formatScheme('https://');
        }
    }

}