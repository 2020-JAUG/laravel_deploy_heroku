<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

use Illuminate\Routing\UrlGenerator;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS')) {
            $url->formatScheme('https://');
        }

        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
