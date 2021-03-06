<?php

declare(strict_types=1);

namespace App\Consumer;

use App\Exception\RdKafkaRuntimeException;
use App\Model\Kafka\SimpleMessage;
use RdKafka\ConsumerTopic;
use Throwable;

class Consumer implements ConsumerInterface
{
    private ConsumerTopic $consumerTopic;

    public function __construct(ConsumerTopic $consumerTopic)
    {
        $this->consumerTopic  = $consumerTopic;
    }

    public function consume(): void
    {
        try {
            $this->consumerTopic->consumeStart(0, RD_KAFKA_OFFSET_STORED);

            while (true) {
                $message = $this->consumerTopic->consume(0, 120*1000);
                $arr = json_decode($message->payload, true);
                if (!$arr) {
                    continue;
                }

                $simpleMessage = new SimpleMessage($arr['id'], $arr['message']);

                echo $simpleMessage->getMessage(). PHP_EOL;
            }
        } catch (Throwable $exception) {
            throw new RdKafkaRuntimeException('Consuming failed', 500, $exception);
        }
    }
}
