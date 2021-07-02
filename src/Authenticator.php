<?php

namespace Fusio\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class Authenticator extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Authenticator::class;
    }
}
