<?php

declare(strict_types=1);

namespace App\Command;

use App\Consumer\ConsumerInterface;

class RunConsumerB extends Command
{
    private ConsumerInterface $consumer;
    protected static string $name = 'consumer:listen:topicB';
    protected static string $description = 'Publishes message to the kafka Topic B';

    public function __construct(ConsumerInterface $consumer)
    {
        $this->consumer = $consumer;
    }

    public function execute(array $args): void
    {
        $this->consumer->consume();
    }
}
