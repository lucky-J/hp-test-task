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
        if ($message->getMessage() !== 'Hi') {
            echo 'Invalid message payload' . PHP_EOL;
            return;
        }

        $message->setMessage(sprintf(
            '%s %s',
            $message->getMessage(),
            $this->getRandomName()
        ));


        $this->producer->publish($message);
    }

    private function getRandomName(): string
    {
        $list = ['Joao', 'Bram', 'Gabriel', 'Fehim', 'Eni', 'Patrick', 'Micha', 'Mirzet', 'Liliana', 'Sebastien'];

        return $list[mt_rand(0, count($list) - 1)];
    }
}
