<?php

namespace App\Providers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('cacheGetJson', function (string $url, array $data = [], int|\DateTime $ttl = 5*60) {
            return \cache()->remember(
                $url,
                $ttl,
                fn() => $this->get($url, $data)->json(),
            );
        });
    }
}
