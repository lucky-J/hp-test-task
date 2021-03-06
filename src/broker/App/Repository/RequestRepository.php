<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\DriverManager;

class RequestRepository implements RepositoryInterface
{
    /**
     * @param int $id
     * @return string
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function getRequestMessageById(int $id): string
    {
        $connection = DriverManager::getConnection([
            'url' => 'pgsql://helloprint:helloprint123@db:5432/helloprint',
        ]);

        $sql = 'SELECT message FROM "Broker".request WHERE id = ?';
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $id);
            $res = $stmt->execute()->fetchOne();
            return $res ?? '';
    }
}
