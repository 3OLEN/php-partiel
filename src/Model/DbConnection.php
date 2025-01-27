<?php

declare(strict_types=1);

namespace App\Model;

final class DbConnection
{
    static private DbConnection $instance;

    public static function createOrGetInstance(): static
    {
        if (isset(static::$instance) === false) {
            static::$instance = new static(
                new \PDO(
                    dsn: 'mysql:host=db;dbname=partiel_php;charset=utf8',
                    username: 'usr',
                    password: 'pwd',
                    options: [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    ]
                )
            );
        }

        return static::$instance;
    }

    private function __construct(
        public readonly \PDO $pdo
    ) {
    }
}
