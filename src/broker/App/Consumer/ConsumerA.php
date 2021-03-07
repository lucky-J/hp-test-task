<?php

declare(strict_types=1);

namespace App\Consumer;

use App\Model\Kafka\MessageInterface;
use App\Producer\ProducerInterface;
use RdKafka\ConsumerTopic;

class ConsumerA extends Consumer
{
    private ProducerInterface $producer;

    public function __construct(ConsumerTopic $consumerTopic, ProducerInterface $repository)
    {
        parent::__construct($consumerTopic);
        $this->producer = $repository;
    }

    function onConsume(MessageInterface $message): void
    {
        $this->producer->publish($message);
    }
}
