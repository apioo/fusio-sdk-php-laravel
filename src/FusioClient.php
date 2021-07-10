<?php

namespace Fusio\Laravel;

use Fusio\Sdk\Client;
use Illuminate\Support\Facades\Facade;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class FusioClient extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
