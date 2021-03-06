<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class RequestRepository implements RepositoryInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return string
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function getRequestMessageById(int $id): string
    {
        $sql = 'SELECT message FROM "Broker".request WHERE id = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(1, $id);
            $res = $stmt->execute()->fetchOne();
            return $res ?? '';
    }
}
