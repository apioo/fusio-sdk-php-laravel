<?php

namespace Fusio\Laravel;

use Fusio\Sdk\Client;
use Illuminate\Contracts\Foundation\Application as App;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Sdkgen\Client\TokenStore\FileTokenStore;
use Sdkgen\Client\TokenStore\MemoryTokenStore;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class FusioServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        MemoryTokenStore::class => MemoryTokenStore::class,
        SessionTokenStore::class => SessionTokenStore::class,
    ];

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/fusio.php' => config_path('fusio.php')
        ]);
    }

    public function register(): void
    {
        $this->app->singleton(FileTokenStore::class, function (App $app) {
            return new FileTokenStore(storage_path('framework/cache'));
        });

        $this->app->singleton(Client::class, function (App $app) {
            return new Client(
                config('fusio.base_uri'),
                config('fusio.app_key'),
                config('fusio.app_secret'),
                config('fusio.scopes'),
                $app->make(FileTokenStore::class)
            );
        });
    }

    public function provides(): array
    {
        return [
            Client::class,
            FileTokenStore::class,
            MemoryTokenStore::class,
            SessionTokenStore::class,
        ];
    }
}
