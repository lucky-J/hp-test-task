<?php

use App\Command;
use App\Consumer;
use App\Factory;
use App\Repository\RequestRepository;

return [
    RequestRepository::class => DI\autowire()->constructor(DI\get('db.connection')),
    'producerA' => DI\factory([Factory\KafkaFactory::class, 'createProducer'])->parameter('config', DI\get('kafka'))->parameter('producerName', 'producerA'),
    'producerB' => DI\factory([Factory\KafkaFactory::class, 'createProducer'])->parameter('config', DI\get('kafka'))->parameter('producerName', 'producerB'),
    'consumerA' => DI\create(Consumer\ConsumerA::class)->constructor(
        DI\factory([Factory\KafkaFactory::class, 'createConsumerTopic'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerRevA'),
        DI\get('producerB')
    ),
    'consumerB' => DI\create(Consumer\ConsumerB::class)->constructor(
        DI\factory([Factory\KafkaFactory::class, 'createConsumerTopic'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerRevB'),
        DI\get(RequestRepository::class)
    ),
    'db.connection' => DI\factory([Factory\DbConnectionFactory::class, 'create'])->parameter('config', DI\get('database')),
    Command\RunConsumerA::class => DI\autowire()->constructor(DI\get('consumerA')),
    Command\RunConsumerB::class => DI\autowire()->constructor(DI\get('consumerB')),
];