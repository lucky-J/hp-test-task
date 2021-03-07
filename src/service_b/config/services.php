<?php

use App\Command;
use App\Consumer;
use App\Factory;
use App\Repository\RequestRepository;

return [
    RequestRepository::class => DI\autowire()->constructor(DI\get('db.connection')),
    'producerA' => DI\factory([Factory\KafkaFactory::class, 'createProducer'])->parameter('config', DI\get('kafka'))->parameter('producerName', 'producerA'),
    'consumerA' => DI\create(Consumer\ConsumerA::class)->constructor(
        DI\factory([Factory\KafkaFactory::class, 'createConsumerTopic'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerA'),
        DI\get('producerA')
    ),
    Command\RunConsumerA::class => DI\autowire()->constructor(DI\get('consumerA')),
];