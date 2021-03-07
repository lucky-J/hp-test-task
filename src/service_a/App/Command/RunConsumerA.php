<?php

declare(strict_types=1);

namespace App\Command;

use App\Consumer\ConsumerInterface;

class RunConsumerA extends Command
{
    private ConsumerInterface $consumer;
    protected static string $name = 'consumer:listen:topicA';
    protected static string $description = 'Publishes message to the kafka Topic A';

    public function __construct(ConsumerInterface $consumer)
    {
        $this->consumer = $consumer;
    }

    public function execute(array $args): void
    {
        $this->consumer->consume();
    }
}
