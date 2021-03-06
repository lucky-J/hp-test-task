<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = App\App::make();

$producerA = \App\Factory\KafkaFactory::createProducer($app->getContainer()->get('kafka'), 'producerA');
$producerA->publish(new \App\Model\Kafka\SimpleMessage(1, 'Hi'));

$consumerA = \App\Factory\KafkaFactory::createConsumer($app->getContainer()->get('kafka'), 'consumerRevA');
$consumerA->consume();