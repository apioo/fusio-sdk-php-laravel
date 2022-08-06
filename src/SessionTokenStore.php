<?php

namespace Fusio\Laravel;

use Sdkgen\Client\AccessToken;
use Sdkgen\Client\TokenStoreInterface;

/**
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @link    https://www.fusio-project.org/
 */
class SessionTokenStore implements TokenStoreInterface
{
    private const SESSION_KEY = 'fusio_access_token';

    public function get(): ?AccessToken
    {
        $token = session(self::SESSION_KEY);
        if (empty($token) || !is_array($token)) {
            return null;
        }

        return AccessToken::fromArray($token);
    }

    public function persist(AccessToken $token): void
    {
        session([self::SESSION_KEY => $token->toArray()]);
    }

    public function remove(): void
    {
        session([self::SESSION_KEY => null]);
    }
}
