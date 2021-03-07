<?php

declare(strict_types=1);

namespace App\Producer;

use App\Exception\RdKafkaRuntimeException;
use App\Model\Kafka\MessageInterface;
use RdKafka\Producer as VendorProducer;
use RdKafka\ProducerTopic;
use RuntimeException;
use Throwable;

class Producer implements ProducerInterface
{
    /**
     * @var ProducerTopic[]
     */
    private array $topics;

    private VendorProducer $rdKafkaProducer;

    public function __construct(VendorProducer $rdKafkaProducer, array $topics)
    {
        $this->topics = $topics;
        $this->rdKafkaProducer = $rdKafkaProducer;
    }

    public function publish(MessageInterface $message): void
    {
        echo $message->getMessage() . PHP_EOL;

        try {
            foreach ($this->topics as $topic) {
                $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($message));
                $this->rdKafkaProducer->poll(0);
            }

            $result = null;
            for ($flushRetries = 0; $flushRetries < 10; $flushRetries++) {
                $result = $this->rdKafkaProducer->flush(10000);
                if (RD_KAFKA_RESP_ERR_NO_ERROR === $result) {
                    break;
                }
            }

            if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
                throw new RuntimeException('Was unable to flush, messages might be lost!');
            }
        } catch (Throwable $exception) {
            throw new RdKafkaRuntimeException('Publish failed', 500, $exception);
        }
    }
}
