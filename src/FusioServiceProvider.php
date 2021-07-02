<?php

namespace Fusio\Laravel;

use Fusio\Laravel\TokenStore\ConfigTokenStore;
use Fusio\Laravel\TokenStore\TokenStoreInterface;
use Fusio\Sdk\Authenticator;
use Fusio\Sdk\Backend\Client as BackendClient;
use Fusio\Sdk\Consumer\Client as ConsumerClient;
use Illuminate\Contracts\Foundation\Application as App;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

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

        $this->app->singleton(BackendClient::class, function (App $app) {
            /** @var TokenStoreInterface $store */
            $store = $app->make(TokenStoreInterface::class);

            return new BackendClient($store->getBaseUri(), $store->getAccessToken());
        });

        $this->app->singleton(ConsumerClient::class, function (App $app) {
            /** @var TokenStoreInterface $store */
            $store = $app->make(TokenStoreInterface::class);

            return new ConsumerClient($store->getBaseUri(), $store->getAccessToken());
        });

        $this->app->singleton(Authenticator::class, function (App $app) {
            /** @var TokenStoreInterface $store */
            $store = $app->make(TokenStoreInterface::class);

            return new Authenticator($store->getBaseUri());
        });

        $this->app->singleton(ConfigTokenStore::class, function (App $app) {
            return new ConfigTokenStore();
        });

        $this->app->bind(TokenStoreInterface::class, ConfigTokenStore::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            BackendClient::class,
            ConsumerClient::class,
            Authenticator::class,
        ];
    }
}
