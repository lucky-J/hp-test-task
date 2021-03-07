<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Throwable;

class RequestRepository implements RepositoryInterface
{
    private const TABLE = '"Broker".request';

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return array
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws Exception
     */
    public function getRequestRecordById(int $id): array
    {
        $sql = 'SELECT * FROM "Broker".request WHERE id = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(1, $id);
            $res = $stmt->execute()->fetchAssociative();

            return $res ?? [];
    }

    public function storeRequest(string $message): int
    {
        $qb = $this->connection->createQueryBuilder();
        $qb->insert(self::TABLE)
            ->values(['message' => '?'])
            ->setParameter(0, $message);

        try {
            $qb->execute();

            $lastId = $this->connection->lastInsertId();

            return is_numeric($lastId) ? (int) $lastId : 0;
        } catch (Throwable $exception) {
            echo $exception->getMessage() . PHP_EOL;
            return 0;
        }
    }

    /**
     * @todo :: send event on update
     *
     * @param int $id
     * @param string $message
     * @param bool $isComplete
     * @return bool
     */
    public function updateRequest(int $id, string $message, bool $isComplete = false): bool
    {
        $qb = $this->connection->createQueryBuilder();
        $qb->update(self::TABLE)
            ->set('message', ':message');
        if ($isComplete) {
            $qb->set('is_complete', ':is_complete');
            $qb->setParameter('is_complete', true);
        }
        $qb->where('id = :id')
            ->setParameter('message', $message)
            ->setParameter('id', $id);

        try {
            return (bool) $qb->execute();
        } catch (Throwable $exception) {
            echo $exception->getMessage() . PHP_EOL;
            return false;
        }
    }
}
