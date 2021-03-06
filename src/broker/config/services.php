<?php

return [
    'producerA' => DI\factory([\App\Factory\KafkaFactory::class, 'createProducer'])->parameter('config', DI\get('kafka'))->parameter('producerName', 'producerA'),
    'consumerA' => DI\factory([\App\Factory\KafkaFactory::class, 'createConsumer'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerRevA'),
    'consumerB' => DI\factory([\App\Factory\KafkaFactory::class, 'createConsumer'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerRevB'),
    'db.connection' => DI\factory([\App\Factory\DbConnectionFactory::class, 'create'])->parameter('config', DI\get('database')),
    \App\Repository\RequestRepository::class => DI\autowire()->constructor(DI\get('db.connection')),
    \App\Command\RunConsumerA::class => DI\autowire()->constructor(DI\get('consumerA')),
    \App\Command\RunConsumerB::class => DI\autowire()->constructor(DI\get('consumerB')),
];