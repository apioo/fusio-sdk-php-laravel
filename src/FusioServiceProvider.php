<?php

namespace Fusio\Laravel;

use Fusio\Sdk\Client;
use Illuminate\Contracts\Foundation\Application as App;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Sdkgen\Client\TokenStore\FileTokenStore;
use Sdkgen\Client\TokenStore\MemoryTokenStore;
use Sdkgen\Client\TokenStoreInterface;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class FusioServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/fusio.php' => config_path('fusio.php'),
            'fusio'
        ]);
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/fusio.php', 'fusio');

        $this->app->singleton(Client::class, function (App $app) {
            /** @var TokenStoreInterface $store */
            $tokenStore = $app->make(FileTokenStore::class);

            return new Client(
                config('fusio.base_uri'),
                config('fusio.app_key'),
                config('fusio.app_secret'),
                config('fusio.scopes'),
                $tokenStore
            );
        });

        $this->app->singleton(FileTokenStore::class, function () {
            return new FileTokenStore();
        });

        $this->app->singleton(MemoryTokenStore::class, function () {
            return new MemoryTokenStore();
        });

        $this->app->singleton(SessionTokenStore::class, function () {
            return new SessionTokenStore();
        });

        // by default we use the memory token store, if you want to persist the access token between requests you need
        // to use a different implementation
        $this->app->bind(TokenStoreInterface::class, SessionTokenStore::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            Client::class,
        ];
    }
}
