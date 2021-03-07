<?php

use App\Command\RunConsumerA;
use App\Command\RunConsumerB;
use App\Factory\DbConnectionFactory;
use App\Factory\KafkaFactory;
use App\Repository\RequestRepository;

return [
    'producerA' => DI\factory([KafkaFactory::class, 'createProducer'])->parameter('config', DI\get('kafka'))->parameter('producerName', 'producerA'),
    'producerB' => DI\factory([KafkaFactory::class, 'createProducer'])->parameter('config', DI\get('kafka'))->parameter('producerName', 'producerB'),
    'consumerA' => DI\factory([KafkaFactory::class, 'createConsumer'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerRevA'),
    'consumerB' => DI\factory([KafkaFactory::class, 'createConsumer'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerRevB'),
    'db.connection' => DI\factory([DbConnectionFactory::class, 'create'])->parameter('config', DI\get('database')),
    RequestRepository::class => DI\autowire()->constructor(DI\get('db.connection')),
    RunConsumerA::class => DI\autowire()->constructor(DI\get('consumerA')),
    RunConsumerB::class => DI\autowire()->constructor(DI\get('consumerB')),
];