<?php

namespace Fusio\Laravel\TokenStore;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class MemoryTokenStore implements TokenStoreInterface
{
    private string $baseUri;
    private string $accessToken;

    public function __construct(string $baseUri, string $accessToken)
    {
        $this->baseUri = $baseUri;
        $this->accessToken = $accessToken;
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
