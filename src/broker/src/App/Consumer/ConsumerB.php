<?php

declare(strict_types=1);

namespace App\Consumer;

use App\Model\Kafka\MessageInterface;
use App\Repository\RepositoryInterface;
use App\Repository\RequestRepository;
use RdKafka\ConsumerTopic;
use Throwable;

class ConsumerB extends Consumer
{
    /**
     * @var RepositoryInterface|RequestRepository
     */
    private RepositoryInterface $repository;

    public function __construct(ConsumerTopic $consumerTopic, RepositoryInterface $repository)
    {
        parent::__construct($consumerTopic);
        $this->repository = $repository;
    }

    function onConsume(MessageInterface $message): void
    {
        try {
            echo $message->getMessage() . PHP_EOL;
            $this->repository->updateRequest($message->getId(), $message->getMessage(), true);
        } catch (Throwable $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }
}
