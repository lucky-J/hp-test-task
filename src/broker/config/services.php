<?php

return [
    'producerA' => DI\factory([\App\Factory\KafkaFactory::class, 'createProducer'])->parameter('config', DI\get('kafka'))->parameter('producerName', 'producerA'),
    'consumerA' => DI\factory([\App\Factory\KafkaFactory::class, 'createConsumer'])->parameter('config', DI\get('kafka'))->parameter('consumerName', 'consumerRevA'),
    'db.connection' => DI\factory([\App\Factory\DbConnectionFactory::class, 'create'])->parameter('config', DI\get('database')),
    \App\Repository\RequestRepository::class => DI\autowire()->constructor(DI\get('db.connection'))
];