<?php

namespace Fusio\Laravel\TokenStore;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
interface TokenStoreInterface
{
    /**
     * @return string
     */
    public function getBaseUri(): string;

    /**
     * @return string
     */
    public function getAccessToken(): string;
}
