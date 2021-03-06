<?php

namespace App\Consumer;

use App\Exception\RdKafkaRuntimeException;

interface ConsumerInterface
{
    /**
     * @throws RdKafkaRuntimeException
     */
    public function consume(): void;
}
