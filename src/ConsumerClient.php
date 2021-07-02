<?php

namespace Fusio\Laravel;

use Fusio\Sdk\Consumer\Client;
use Illuminate\Support\Facades\Facade;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class ConsumerClient extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
