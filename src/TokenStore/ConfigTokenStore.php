<?php

namespace Fusio\Laravel\TokenStore;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class ConfigTokenStore implements TokenStoreInterface
{
    public function getBaseUri(): string
    {
        return config('fusio.base_uri');
    }

    public function getAccessToken(): string
    {
        return config('fusio.access_token');
    }
}
