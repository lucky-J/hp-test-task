<?php

namespace App\Producer;

use App\Exception\RdKafkaRuntimeException;
use App\Model\Kafka\MessageInterface;

interface ProducerInterface
{
    /**
     * @param MessageInterface $message
     * @throws RdKafkaRuntimeException
     */
    public function publish(MessageInterface $message): void;
}