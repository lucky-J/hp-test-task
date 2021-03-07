<?php

declare(strict_types=1);

namespace App\Factory;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DbConnectionFactory
{
    /**
     * @param array $config
     * @return Connection
     * @throws \Doctrine\DBAL\Exception
     */
    public static function create(array $config): Connection
    {
        return DriverManager::getConnection(['url' => $config['dsn']]);
    }
}
