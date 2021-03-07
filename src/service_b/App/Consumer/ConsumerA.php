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
        $wordsCount = str_word_count($message->getMessage());
        if ($wordsCount !== 2) {
            echo 'Invalid message payload. Message: ' . $message->getMessage() . PHP_EOL;
            return;
        }

        $message->setMessage(sprintf('%s Bye', $message->getMessage()));

        $this->producer->publish($message);
    }
}
