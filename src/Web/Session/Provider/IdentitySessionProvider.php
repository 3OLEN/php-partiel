<?php

declare(strict_types=1);

namespace App\Web\Session\Provider;

class IdentitySessionProvider
{
    private const string IDENTITY_SESSION_KEY = 'identity';

    public static function getIdentity(): string
    {
        return $_SESSION[static::IDENTITY_SESSION_KEY];
    }

    public static function hasStoredIdentity(): bool
    {
        return array_key_exists(key: static::IDENTITY_SESSION_KEY, array: $_SESSION)
            && is_string($_SESSION[static::IDENTITY_SESSION_KEY]);
    }

    public static function storeIdentity(string $identity): void
    {
        $_SESSION[static::IDENTITY_SESSION_KEY] = $identity;
    }

    public static function resetIdentity(): void
    {
        unset($_SESSION[static::IDENTITY_SESSION_KEY]);
    }
}
